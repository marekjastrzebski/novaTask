<?php
declare(strict_types=1);
namespace App\Command;

use App\Entity\Locodes;
use App\Services\Locode\LocoderBuilder;
use App\Services\Locode\LocodeResourceHandler;
use App\Services\Locode\SubDivisionReader;
use App\Utils\DatabaseTools;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\SerializerInterface;

#[AsCommand(name: 'app:locode:load')]
class LocodeLoaderCommand extends Command
{
    public function __construct(
        private readonly LocodeResourceHandler $resourceScanner,
        private readonly SubDivisionReader     $subDivisionReader,
        private readonly SerializerInterface   $serializer,
        private readonly ManagerRegistry $registry,
        private readonly LoggerInterface $locodeLoaderLogger,
        private readonly DatabaseTools $databaseTools,
    )
    {
        parent::__construct();
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        $this->locodeLoaderLogger->info('START >> LOCODE Loader');
        if (!$this->resourceScanner->checkResource()) {
            $this->locodeLoaderLogger->warning('Could not load file, file not exists');
            $this->locodeLoaderLogger->info('STOP >> LOCODE Loader');

            return Command::FAILURE;
        }
        try {
            $this->resourceScanner->extractZip();
            $this->subDivisionReader->setSubDivisionResource($this->resourceScanner->getSubdivisionCodesFile());

            foreach ($this->resourceScanner->getUnlocodeFiles() as $unlocodeFile) {
                $locodeFileArray = $this->serializer->decode(
                    utf8_encode(file_get_contents($unlocodeFile)),
                    'csv',
                    [
                        CsvEncoder::NO_HEADERS_KEY => true
                    ]
                );
                $output->writeln("<info>Processing: </info>$unlocodeFile");
                $this->locodeLoaderLogger->info("Processing: $unlocodeFile");
                $this->populateLocodeEntities($locodeFileArray, $output);
                $output->writeln('');
            }
            $output->writeln("<info>Saving Entities</info>");
            $this->registry->getManager()->flush();
            $output->writeln("<info>All Entities has been saved</info>");

        } catch (\Exception $exception) {
            $this->locodeLoaderLogger->critical($exception->getMessage());
            $this->locodeLoaderLogger->info('STOP >> LOCODE Loader');
            $output->writeln('<error>LOCODE loading failed</error>');

            $this->databaseTools->truncateTable('locodes');
            $this->resourceScanner->clearCache();

            return Command::FAILURE;
        }
        $this->locodeLoaderLogger->info('STOP >> LOCODE Loader');
        $this->resourceScanner->clearResource();
        $this->resourceScanner->clearCache();

        return Command::SUCCESS;
    }

    private function populateLocodeEntities(array $locodeFileArray, OutputInterface $output): void
    {
        $progress = new ProgressBar($output, count($locodeFileArray));
        $progress->start();
        foreach ($locodeFileArray as $locodeRow) {
            $progress->advance();
            $locode = new LocoderBuilder(new Locodes());
            $locode->persistSubDivisions($this->subDivisionReader);
            $locode->persistRow($locodeRow);
            $this->registry->getManager()->persist($locode->getEntity());
        }
        $progress->finish();
    }
}
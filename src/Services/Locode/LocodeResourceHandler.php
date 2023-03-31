<?php
declare(strict_types=1);

namespace App\Services\Locode;

class LocodeResourceHandler
{
    private ?string $resourceDir = null;
    private null|array|string $zipName = null;
    private ?string $extractedZipDir = null;
    private ?string $subdivisionCodesFile = null;
    private ?array $unlocodeFiles = null;

    public function __construct(
        string $appDir
    )
    {
        $this->resourceDir = $appDir . $_ENV['APP_RESOURCE_LOCODES'];
    }

    public function checkResource(): bool
    {
        return $this->findZip();
    }

    public function extractZip(): bool
    {
        if (count($this->zipName) > 1) {
            return false;
        }
        $zipDir = $this->resourceDir . $this->zipName[0];
        $this->extractedZipDir = $this->resourceDir . basename($zipDir, '.zip');
        $extractor = new \ZipArchive();
        $extractor->open($zipDir);
        $extractor->extractTo($this->extractedZipDir);
        $this->scanExtractedFiles($this->extractedZipDir);

        return true;
    }

    private function findZip(): bool
    {
        $filter = static function ($path) {
            return str_contains($path, 'csv.zip');
        };

        $this->zipName = array_values(
            array_filter(scandir($this->resourceDir), $filter)
        );

        return (bool)$this->zipName;
    }

    private function scanExtractedFiles(string $directory): void
    {
        $findSubDiv = static function ($value) {
            return str_contains($value, 'SubdivisionCodes');
        };
        $findUnlocodes = static function ($value) {
            return str_contains($value, 'UNLOCODE') && str_contains($value, '.csv');
        };

        $this->unlocodeFiles = array_values(
            array_filter(
                scandir($directory),
                $findUnlocodes
            )
        );
        $this->subdivisionCodesFile = array_values(
            array_filter(
                scandir($directory),
                $findSubDiv
            )
        )[0] ?? null;
    }

    /**
     * @return string|null
     */
    public function getSubdivisionCodesFile(): ?string
    {
        return $this->extractedZipDir . '/' . $this->subdivisionCodesFile;
    }

    /**
     * @return array|null
     */
    public function getUnlocodeFiles(): ?array
    {
        $map = function ($file) {
            return $this->extractedZipDir . '/' . $file;
        };

        return array_map($map, $this->unlocodeFiles);
    }

    public function clearCache(): void
    {
        foreach (scandir($this->extractedZipDir) as $file) {
            if (!is_dir($this->extractedZipDir . '/' . $file)) {
                unlink($this->extractedZipDir . '/' . $file);
            }
        }

        rmdir($this->extractedZipDir);
    }

    public function clearResource(): void
    {
        unlink($this->resourceDir . $this->zipName[0]);
    }
}
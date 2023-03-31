<?php
declare(strict_types=1);
namespace App\Utils;

use Doctrine\ORM\EntityManagerInterface;

class DatabaseTools
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager
    )
    {
    }

    public function truncateTable(?string $tableName): void
    {
        if (!$tableName) {
            return;
        }
        $platform = $this->entityManager->getConnection()->getDatabasePlatform();
        $this->entityManager
            ->getConnection()
            ->executeQuery(
                $platform?->getTruncateTableSQL($tableName, true)
            );
    }
}
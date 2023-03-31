<?php

namespace App\Services\Locode;

use Symfony\Component\Serializer\Encoder\CsvEncoder;
use Symfony\Component\Serializer\SerializerInterface;

class SubDivisionReader
{
    private array $subdivisions = [];

    public function __construct(
        private readonly SerializerInterface $serializer
    )
    {
    }

    public function setSubDivisionResource(string $filePath): void
    {
        if (!file_exists($filePath)) {
            return;
        }
        $subDivArray = $this->serializer->decode(
            utf8_encode(file_get_contents($filePath)),
            'csv',
            [
                CsvEncoder::NO_HEADERS_KEY => true
            ]
        );
        $this->subdivisions = $this->reorganizeSubDivisions($subDivArray);
    }

    public function getSubdivision(string $countryCode, string $subdivisionCode): string
    {
        return implode(
            "/",
            $this->subdivisions[$countryCode][$subdivisionCode] ?? []
        );
    }

    private function reorganizeSubDivisions(array $subDivisions): array
    {
        if (!$subDivisions) {
            return [];
        }
        $reorganized = [];
        foreach ($subDivisions as $subDivision) {
            $reorganized[$subDivision[0]][$subDivision[1]][] = $subDivision[2];
            $reorganized[$subDivision[0]][$subDivision[1]][] = $subDivision[3];
        }

        return $reorganized;
    }
}
<?php

namespace App\Services\Locode;

use App\Entity\Locodes;

class LocoderBuilder
{
    private ?SubDivisionReader $subDivision;

    public function __construct(
        private ?Locodes $locodes
    )
    {
    }

    public function persistSubDivisions(?SubDivisionReader $subDivision): void
    {
        $this->subDivision = $subDivision;
    }

    public function persistRow(?array $row): self
    {
        if (!$this->locodes || !$row) {
            return $this;
        }
        $functions = new FunctionDecoder($row[6] ?? null);
        $this->locodes->setLocode($row[1] . $row[2] ?? '');
        $this->locodes->setName($row[3] ?? null);
        $this->locodes->setNameWoDiacritics($row[4] ?? null);
        $this->locodes->setSubDiv($row[5] ?? null);
        $this->locodes->setSubDivName($this->subDivision->getSubdivision($row[1] ?? null, $row[5] ?? null));
        $this->locodes->setPortTerminal($functions->getPortTerminal());
        $this->locodes->setAirportTerminal($functions->getAirportTerminal());
        $this->locodes->setRoadTerminal($functions->getRoadTerminal());
        $this->locodes->setRailTerminal($functions->getRailTerminal());
        $this->locodes->setPostalExchange($functions->getPostalExchange());
        $this->locodes->setMultimodal($functions->getMultimodal());
        $this->locodes->setFixed($functions->getFixed());
        $this->locodes->setBorderCrossing($functions->getBorderCrossing());
        $this->locodes->setStatus($row[7] ?? null);
        $this->locodes->setDate($row[8] ?? null);
        $this->locodes->setIata($row[9] ?? null);
        $this->locodes->setCoordinates($row[10] ?? null);
        $this->locodes->setRemarks($row[11] ?? null);

        return $this;
    }

    public function getEntity(): ?Locodes
    {
        return $this->locodes;
    }
}
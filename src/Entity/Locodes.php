<?php

namespace App\Entity;

use App\Repository\LocodesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocodesRepository::class)]
class Locodes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $locode = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    private ?string $nameWoDiacritics = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subDiv = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $subDivName = null;

    #[ORM\Column(nullable: true)]
    private ?bool $portTerminal = null;

    #[ORM\Column(nullable: true)]
    private ?bool $airportTerminal = null;

    #[ORM\Column(nullable: true)]
    private ?bool $railTerminal = null;

    #[ORM\Column(nullable: true)]
    private ?bool $roadTerminal = null;

    #[ORM\Column(nullable: true)]
    private ?bool $postalExchange = null;

    #[ORM\Column(nullable: true)]
    private ?bool $multimodal = null;

    #[ORM\Column(nullable: true)]
    private ?bool $fixed = null;

    #[ORM\Column( nullable: true)]
    private ?bool $borderCrossing = null;

    #[ORM\Column(length: 255)]
    private ?string $date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $status = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $iata = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $coordinates = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $remarks = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLocode(): ?string
    {
        return $this->locode;
    }

    public function setLocode(string $locode): self
    {
        $this->locode = $locode;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNameWoDiacritics(): ?string
    {
        return $this->nameWoDiacritics;
    }

    public function setNameWoDiacritics(string $nameWoDiacritics): self
    {
        $this->nameWoDiacritics = $nameWoDiacritics;

        return $this;
    }

    public function getSubDiv(): ?string
    {
        return $this->subDiv;
    }

    public function setSubDiv(?string $subDiv): self
    {
        $this->subDiv = $subDiv;

        return $this;
    }

    public function getSubDivName(): ?string
    {
        return $this->subDivName;
    }

    public function setSubDivName(?string $subDivName): self
    {
        $this->subDivName = $subDivName;

        return $this;
    }

    public function isPortTerminal(): ?bool
    {
        return $this->portTerminal;
    }

    public function setPortTerminal(?bool $portTerminal): self
    {
        $this->portTerminal = $portTerminal;

        return $this;
    }

    public function isAirportTerminal(): ?bool
    {
        return $this->airportTerminal;
    }

    public function setAirportTerminal(?bool $airportTerminal): self
    {
        $this->airportTerminal = $airportTerminal;

        return $this;
    }

    public function isRailTerminal(): ?bool
    {
        return $this->railTerminal;
    }

    public function setRailTerminal(?bool $railTerminal): self
    {
        $this->railTerminal = $railTerminal;

        return $this;
    }

    public function isRoadTerminal(): ?bool
    {
        return $this->roadTerminal;
    }

    public function setRoadTerminal(?bool $roadTerminal): self
    {
        $this->roadTerminal = $roadTerminal;

        return $this;
    }

    public function isPostalExchange(): ?bool
    {
        return $this->postalExchange;
    }

    public function setPostalExchange(?bool $postalExchange): self
    {
        $this->postalExchange = $postalExchange;

        return $this;
    }

    public function isMultimodal(): ?bool
    {
        return $this->multimodal;
    }

    public function setMultimodal(?bool $multimodal): self
    {
        $this->multimodal = $multimodal;

        return $this;
    }

    public function isFixed(): ?bool
    {
        return $this->fixed;
    }

    public function setFixed(?bool $fixed): self
    {
        $this->fixed = $fixed;

        return $this;
    }

    public function isBorderCrossing(): ?bool
    {
        return $this->borderCrossing;
    }

    public function setBorderCrossing(?bool $borderCrossing): self
    {
        $this->borderCrossing = $borderCrossing;

        return $this;
    }

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getIata(): ?string
    {
        return $this->iata;
    }

    public function setIata(?string $iata): self
    {
        $this->iata = $iata;

        return $this;
    }

    public function getCoordinates(): ?string
    {
        return $this->coordinates;
    }

    public function setCoordinates(?string $coordinates): self
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    public function getRemarks(): ?string
    {
        return $this->remarks;
    }

    public function setRemarks(?string $remarks): self
    {
        $this->remarks = $remarks;

        return $this;
    }
}

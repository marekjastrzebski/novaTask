<?php
declare(strict_types=1);
namespace App\Services\Locode;

class FunctionDecoder
{
    private ?bool $portTerminal = null;
    private ?bool $airportTerminal = null;
    private ?bool $railTerminal = null;
    private ?bool $roadTerminal = null;
    private ?bool $postalExchange = null;
    private ?bool $multimodal = null;
    private ?bool $fixed = null;
    private ?bool $borderCrossing = null;

    public function __construct(
       private readonly ?string $functions
    )
    {
        $this->setFunctions();
    }

    private function setFunctions(): void
    {
        if(!$this->functions || $this->functions[0] === '0'){
            return;
        }
        $this->portTerminal = $this->functions[0] === '1';
        $this->railTerminal = $this->functions[1] === '2';
        $this->roadTerminal = $this->functions[2] === '3';
        $this->airportTerminal = $this->functions[3] === '4';
        $this->postalExchange = $this->functions[4] === '5';
        $this->multimodal = $this->functions[5] === '6';
        $this->fixed = $this->functions[6] === '7';
        $this->borderCrossing = $this->functions[7] === 'B';
    }

    /**
     * @return bool|null
     */
    public function getPortTerminal(): ?bool
    {
        return $this->portTerminal;
    }

    /**
     * @return bool|null
     */
    public function getAirportTerminal(): ?bool
    {
        return $this->airportTerminal;
    }

    /**
     * @return bool|null
     */
    public function getRailTerminal(): ?bool
    {
        return $this->railTerminal;
    }

    /**
     * @return bool|null
     */
    public function getRoadTerminal(): ?bool
    {
        return $this->roadTerminal;
    }

    /**
     * @return bool|null
     */
    public function getPostalExchange(): ?bool
    {
        return $this->postalExchange;
    }

    /**
     * @return bool|null
     */
    public function getMultimodal(): ?bool
    {
        return $this->multimodal;
    }

    /**
     * @return bool|null
     */
    public function getFixed(): ?bool
    {
        return $this->fixed;
    }

    /**
     * @return bool|null
     */
    public function getBorderCrossing(): ?bool
    {
        return $this->borderCrossing;
    }
}
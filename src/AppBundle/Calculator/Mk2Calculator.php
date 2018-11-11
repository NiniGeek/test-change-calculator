<?php

declare(strict_types=1);

namespace AppBundle\Calculator;

class Mk2Calculator extends AbstractCalculator implements CalculatorInterface
{
    /**
     * @inheritdoc
     */
    public function getSupportedModel(): string
    {
        return 'mk2';
    }

    /**
     * @inheritdoc
     */
    protected function getAvailableChange(): array
    {
        return [
           'bill10' => 10,
           'bill5' => 5,
           'coin2' => 2,
        ];
    }
}

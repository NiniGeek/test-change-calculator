<?php

declare(strict_types=1);

namespace AppBundle\Calculator;

use AppBundle\Model\Change;

class Mk1Calculator implements CalculatorInterface
{
    /**
     * {@inheritdoc}
     */
    public function getSupportedModel(): string
    {
        return 'mk1';
    }

    /**
     * {@inheritdoc}
     */
    public function getChange(int $amount): ?Change
    {
        $change = new Change();
        $change->coin1 = $amount;

        return $change;
    }
}

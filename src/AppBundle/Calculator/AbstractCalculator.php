<?php

declare(strict_types=1);

namespace AppBundle\Calculator;

use AppBundle\Model\Change;

abstract class AbstractCalculator
{
    /**
     * @return array Available change ordered by priority with Name => Value
     */
    abstract protected function getAvailableChange(): array;

    /**
     * @param int $amount The amount of money to turn into change
     *
     * @return Change|null The change, or null if the operation is impossible
     */
    public function getChange(int $amount): ?Change
    {
        $change = null;
        $remainingAmount = $amount;
        foreach ($this->getAvailableChange() as $changeName => $changeValue) {
            if ($changeValue > $amount) {
                continue;
            }

            $value = (int) ($remainingAmount / $changeValue);
            if (0 === $value) {
                continue;
            }

            if (null === $change) {
                $change = new Change();
            }

            $remainingAmount %= $changeValue;
            $change->$changeName = $value;
        }

        if (0 !== $remainingAmount) {
            return null;
        }

        return $change;
    }
}

<?php

declare(strict_types=1);

namespace AppBundle\Registry;

use AppBundle\Calculator\CalculatorInterface;

class CalculatorRegistry implements CalculatorRegistryInterface
{
    /**
     * {@inheritdoc}
     */
    public function getCalculatorFor(string $model): ?CalculatorInterface
    {
        $classCalculator = $this->getClassCalculatorFromModel($model);
        if (!class_exists($classCalculator)) {
            return null;
        }

        $instanceCalculator = new $classCalculator();

        if (!$instanceCalculator instanceof CalculatorInterface) {
            return null;
        }

        return $instanceCalculator;
    }

    /**
     * @param string $model
     *
     * @return string
     */
    private function getClassCalculatorFromModel(string $model): string
    {
        return 'AppBundle\Calculator\\' . ucfirst($model) . 'Calculator';
    }
}

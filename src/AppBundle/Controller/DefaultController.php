<?php

declare(strict_types=1);

namespace AppBundle\Controller;

use AppBundle\Registry\CalculatorRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/automaton/{model}/change/{amount}", name="automation.change", requirements={"amount"="\d+"})
     *
     * @param CalculatorRegistry $calculatorRegistry
     * @param string             $model
     * @param int                $amount
     *
     * @return Response
     */
    public function automationModelChange(CalculatorRegistry $calculatorRegistry, string $model, int $amount): Response
    {
        $calculator = $calculatorRegistry->getCalculatorFor($model);

        if (null === $calculator) {
            return new Response('', Response::HTTP_NOT_FOUND);
        }

        $change = $calculator->getChange($amount);

        if (null === $change) {
            return new Response('', Response::HTTP_NO_CONTENT);
        }

        return new JsonResponse($change);
    }
}

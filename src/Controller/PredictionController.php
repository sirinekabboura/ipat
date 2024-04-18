<?php

namespace App\Controller;

use App\Service\FlaskIntegrationService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Process\Process;

class PredictionController extends AbstractController
{
    /**
     * @Route("/prediction", name="app_prediction")
     */
    public function index(): Response
    {
        return $this->render('prediction/index.html.twig', [
            'controller_name' => 'PredictionController',
        ]);
    }


    /**
     * @Route("/predict", name="prediction", methods={"GET", "POST"})
     */
    public function index1(Request $request,FlaskIntegrationService $flaskIntegrationService): Response
    {
        $data = [
            'Coefficient' => $request->request->get('Coefficient'),
            'Age' => $request->request->get('Age'),
        ];
        $predictions = $flaskIntegrationService->executeFlaskAPI($data);

        // Process the predictions and return a response
        return $this->render('prediction/result.html.twig', ['predictions' => $predictions]);
    }

}

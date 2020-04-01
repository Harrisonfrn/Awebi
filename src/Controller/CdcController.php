<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CdcController extends AbstractController
{
    /**
     * @Route("/cdc", name="cdc")
     */
    public function index()
    {
        return $this->render('cdc/index.html.twig', [
            'controller_name' => 'CdcController',
        ]);
    }
}

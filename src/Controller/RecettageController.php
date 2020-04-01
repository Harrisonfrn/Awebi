<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RecettageController extends AbstractController
{
    /**
     * @Route("/recettage", name="recettage")
     */
    public function index()
    {
        return $this->render('recettage/index.html.twig', [
            'controller_name' => 'RecettageController',
        ]);
    }
}

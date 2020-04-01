<?php

namespace App\Controller;

use App\Entity\Cdc;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index()
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/rapport/historique", name="historique")
     */
    public function historique()
    {
       $repo = $this->getDoctrine()->getRepository(Cdc::class);
       dump($repo);

        return $this->render('home/historique.html.twig');
    }

    /**
     * @Route("/rapport/12", name="rapport_show")
     */
    public function show()
    {
        return $this->render('home/show.html.twig');
    }
}

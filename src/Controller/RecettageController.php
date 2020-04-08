<?php

namespace App\Controller;

use App\Entity\Recettage;
use App\Form\RecettageType;
use App\Repository\RecettageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class RecettageController extends AbstractController
{

    private $recettageRepository;

    public function __construct(RecettageRepository $recettageRepository, EntityManagerInterface $em)
    {
        $this->recettageRepository = $recettageRepository;
        $this->em = $em;
    }

    /**
     * @Route("/newRecettage", name="new_recettage")
     */
    public function new(Request $request)
    {
        $recettage = new Recettage;
        $recettageForm = $this->createForm(RecettageType::class, $recettage);
        $recettageForm->handleRequest($request);

        if ($recettageForm->isSubmitted() && $recettageForm->isValid()) {
            $this->em->persist($recettage);
            $this->em->flush();
            

            return $this->redirectToRoute('historique');
        }

        return $this->render('recettage/newRecettage.html.twig', [
            'recettage' => $recettage,
            'recettageForm' => $recettageForm->createView(),
            'current_menu' => 'creationRecettage'
        ]);
    }
}

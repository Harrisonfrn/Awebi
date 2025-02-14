<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Cdc;
use App\Form\CdcType;
use App\Repository\CdcRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

class CdcController extends AbstractController
{

    private $em;

    public function __construct(CdcRepository $cdcRepository, EntityManagerInterface $em)
    {
        $this->cdcRepository = $cdcRepository;
        $this->em = $em;
    }

    /**
     * @Route("/newCdc", name="cdc_new")
     */
    public function new(Request $request)
    {
        $cdc = new Cdc;
        $cdcForm = $this->createForm(CdcType::class, $cdc);
        $cdcForm->handleRequest($request);

        if ($cdcForm->isSubmitted() && $cdcForm->isValid()) {
            $this->em->persist($cdc);
            $this->em->flush();
            

            return $this->redirectToRoute('historique');
        }

        return $this->render('cdc/newCdc.html.twig', [
            'cdc' => $cdc,
            'cdcForm' => $cdcForm->createView(),
            'current_menu' => 'creationCdc'
        ]);
    }

     /**
     * @Route("/client/edition/cahier_des_charges/{id}", name="client_editCdc", methods="GET|POST")
     */
    /*public function editCdc(Cdc $cdc, Request $request)
    {
        $cdcForm = $this->createForm(CdcType::class, $cdc);
        $cdcForm->handleRequest($request);

        if ($cdcForm->isSubmitted() && $cdcForm->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Cahier des charges modifié avec succès');

            return $this->redirectToRoute('historiqueCdc');
        }

        return $this->render('admin/rapport/editCdc.html.twig',[
            'cdc' => $cdc,
            'cdcForm' => $cdcForm->createView()
        ]);
    }*/
}

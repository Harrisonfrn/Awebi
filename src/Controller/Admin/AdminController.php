<?php

namespace App\Controller\Admin;

use App\Entity\Cdc;
use App\Entity\Recettage;
use App\Form\CdcType;
use App\Form\RecettageType;
use App\Repository\CdcRepository;
use App\Repository\RecettageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    private $cdcRepository;
    private $recettageRepository;

    private $em;

    public function __construct(CdcRepository $cdcRepository, RecettageRepository $recettageRepository, EntityManagerInterface $em)
    {
        $this->cdcRepository = $cdcRepository;
        $this->recettageRepository = $recettageRepository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $cdcs = $this->cdcRepository->findAll();
        $recettages = $this->recettageRepository->findAll();

        return $this->render('admin/rapport/index.html.twig', compact('cdcs', 'recettages'));
    }

    /**
     * @Route("/admin/cahier_des_charges/{id}", name="admin_editCdc", methods="GET|POST")
     */
    public function editCdc(Cdc $cdc, Request $request)
    {
        $cdcForm = $this->createForm(CdcType::class, $cdc);
        $cdcForm->handleRequest($request);

        if ($cdcForm->isSubmitted() && $cdcForm->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Cahier des charges modifié avec succès');

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/rapport/editCdc.html.twig',[
            'cdc' => $cdc,
            'cdcForm' => $cdcForm->createView()
        ]);
    }

    /**
     * @Route("/admin/recettage/{id}", name="admin_editRecettage", methods="GET|POST")
     */
    public function editRecettage(Recettage $recettage, Request $request)
    {
        $recettageForm = $this->createForm(RecettageType::class, $recettage);
        $recettageForm->handleRequest($request);

        if ($recettageForm->isSubmitted() && $recettageForm->isValid()) {
            $this->em->flush();
            $this->addFlash('success', 'Recettage modifié avec succès');

            return $this->redirectToRoute('admin');
        }

        return $this->render('admin/rapport/editRecettage.html.twig',[
            'recettage' => $recettage,
            'recettageForm' => $recettageForm->createView()
        ]);
    }

    /**
     * @Route("admin/deleteCdc/{id}", name="admin_deleteCdc", methods="DELETE")
     */
    public function deleteCdc(Cdc $cdc, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $cdc->getId(), $request->get('_token'))) {
            $this->em->remove($cdc);
            $this->em->flush();
            $this->addFlash('success', 'Cahier des charges supprimé avec succès');
        }

        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("admin/deleteRecettage/{id}", name="admin_deleteRecettage", methods="DELETE")
     */
    public function deleteRecettage(Recettage $recettage, Request $request)
    {
        if ($this->isCsrfTokenValid('delete' . $recettage->getId(), $request->get('_token'))) {
            $this->em->remove($recettage);
            $this->em->flush();
            $this->addFlash('success', 'Recettage supprimé avec succès');
        }

        return $this->redirectToRoute('admin');
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Cdc;
use App\Form\CdcType;
use App\Repository\CdcRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{

    private $cdcRepository;

    private $em;

    public function __construct(CdcRepository $cdcRepository, EntityManagerInterface $em)
    {
        $this->cdcRepository = $cdcRepository;
        $this->em = $em;
    }

    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        $cdcs = $this->cdcRepository->findAll();

        return $this->render('admin/rapport/index.html.twig', compact('cdcs'));
    }

    /**
     * @Route("/admin/{id}", name="admin_editCdc", methods="GET|POST")
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
     * @Route("admin/delete/{id}", name="admin_deleteCdc", methods="DELETE")
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
}

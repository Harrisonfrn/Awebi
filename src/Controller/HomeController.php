<?php

namespace App\Controller;

use App\Entity\Cdc;
use App\Repository\CdcRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @var CdcRepository
     */
    private $cdcRepository;

    public function __construct(CdcRepository $cdcRepository, EntityManagerInterface $em)
    {
        $this->cdcRepository = $cdcRepository;
        $this->em = $em;
    }

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
    public function historique(CdcRepository $cdcRepository)
    {
        $cdcs = $cdcRepository->findLatest();

        // $recettage = $this->recettageRepository->find(1);
        // dump($recettage);

        return $this->render('home/historique.html.twig', [
            'cdcs' => $cdcs,
            'current_menu' => 'rapports'
        ]);
    }

    /**
     * @Route("/rapport/{slug}-{id}", name="cdc_show", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function showCdc(Cdc $cdc, string $slug)
    {
        if($cdc->getSlug() !== $slug){
            return $this->redirectToRoute('cdc_show',[
                'id' => $cdc->getId(),
                'slug' => $cdc->getSlug()
            ], 301);
        }

        return $this->render('cdc/showCdc.html.twig', [
            'cdc' => $cdc,
            'current_menu' => 'rapports'
        ]);
    }

    /**
     * @Route("/rapport/12", name="recettage_show")
     */
    public function showRecettage()
    {
        return $this->render('recettage/showRecettage.html.twig');
    }
}

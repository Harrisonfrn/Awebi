<?php

namespace App\Controller;

use App\Entity\Cdc;
use App\Entity\Recettage;
use App\Repository\CdcRepository;
use App\Repository\RecettageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Dompdf\Dompdf;
use Dompdf\Options;

class HomeController extends AbstractController
{
    /**
     * @var CdcRepository
     */
    private $cdcRepository;
    private $recettageRepository;

    public function __construct(CdcRepository $cdcRepository, RecettageRepository $recettageRepository, EntityManagerInterface $em)
    {
        $this->cdcRepository = $cdcRepository;
        $this->recettageRepository = $recettageRepository;
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
     * @Route("/rapport/historiqueCdc", name="historiqueCdc")
     */
    public function historiqueCdc(CdcRepository $cdcRepository)
    {
        $cdcs = $cdcRepository->findAllVisible();

        return $this->render('home/historiqueCdc.html.twig', [
            'cdcs' => $cdcs
        ]);
    }

    /**
     * @Route("/rapport/historiqueRecettage", name="historiqueRecettage")
     */
    public function historiqueRecettage(RecettageRepository $recettageRepository)
    {
        $recettages = $recettageRepository->findAllVisible();

        return $this->render('home/historiqueRecettage.html.twig', [
            'recettages' => $recettages
        ]);
    }

    /**
     * @Route("/rapport/cahier_des_charges/{slug}-{id}", name="cdc_show", requirements={"slug": "[a-z0-9\-]*"})
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
            'cdc' => $cdc
        ]);
    }

    /**
     * @Route("/rapport/recettage/{slug}-{id}", name="recettage_show", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function showRecettage(Recettage $recettage, string $slug)
    {
        if($recettage->getSlug() !== $slug){
            return $this->redirectToRoute('recettage_show',[
                'id' => $recettage->getId(),
                'slug' => $recettage->getSlug()
            ], 301);
        }

        return $this->render('recettage/showRecettage.html.twig',[
            'recettage' => $recettage,
        ]);
    }

    /**
     * @Route("/pdfCdc/{slug}-{id}", name="pdfCdc", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function downloadPdfCdc(Cdc $cdc)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('Cdc/pdfCdc.html.twig', [
            'cdc' => $cdc
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Cahier_Des_Charges.pdf", [
            "Attachment" => true
        ]);
    }


    /**
     * @Route("/pdfRecettage/{slug}-{id}", name="pdfRecettage", requirements={"slug": "[a-z0-9\-]*"})
     */
    public function downloadPdfRecettage(Recettage $recettage)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('recettage/pdfRecettage.html.twig', [
            'recettage' => $recettage
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'portrait'
        $dompdf->setPaper('A4', 'portrait');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (force download)
        $dompdf->stream("Recettage.pdf", [
            "Attachment" => true
        ]);
    }
}

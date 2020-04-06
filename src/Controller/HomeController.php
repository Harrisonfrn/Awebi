<?php

namespace App\Controller;

use App\Entity\Cdc;
use App\Repository\CdcRepository;
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
}

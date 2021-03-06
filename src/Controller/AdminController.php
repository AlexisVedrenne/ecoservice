<?php

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\QuoteRepository;
use App\Repository\ServiceRepository;
use App\Repository\UserRepository;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use App\Entity\Quote;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/stats/customer", name="stats_customer")
     * @IsGranted("ROLE_ADMIN")
     */
    public function statscustomer(UserRepository $repoUser, OrderRepository $repoOrder)
    {
        return $this->render('admin/statscustomeradmin.html.twig', ['users' => $repoUser->findAll(), 'orders' => $repoOrder->findAll(), 'statUsers' => $repoUser->getUserCreateMonth(), 'statOrders' => $repoOrder->getOrderCreateMonth()]);
    }

    /**
     * @Route("/stats/services", name="stats_services")
     * @IsGranted("ROLE_ADMIN")
     */
    public function statsservices(ServiceRepository $repo, QuoteRepository $repoQuote)
    {
        return $this->render('admin/statsservicesadmin.html.twig', ['services' => $repo->findAll(), 'quotes' => $repoQuote->findAll(), 'statsQuote' => $repoQuote->getQuoteCreateMonth()]);
    }

    /**
     * @Route("/manager/product", name="gestion_produit")
     * @IsGranted("ROLE_ADMIN")
     */
    public function indexproductmanagement(ProductRepository $repo, FileUploader $fileUploader)
    {
        return $this->render('admin/productmanagement.html.twig', ['products' => $repo->findAll(), 'file' => $fileUploader]);
    }

    /**
     * @Route("/manager/services", name="gestion_services")
     * @IsGranted("ROLE_ADMIN")
     */
    public function indexservicesmanagement(ServiceRepository $repo, FileUploader $fileUploader)
    {
        return $this->render('admin/servicesmanagement.html.twig', ['services' => $repo->findAll(), 'file' => $fileUploader]);
    }

    /**
     * @Route("/manager/quotes", name="gestion_devis")
     * @IsGranted("ROLE_COM")
     */
    public function indexquotemanagement(QuoteRepository $repo)
    {
        return $this->render('admin/quotesmanagement.html.twig', ['quotes' => $repo->findAll()]);
    }

    /**
     * @Route("/login", name="login")
     */
    public function adminLogin()
    {
        return $this->render('admin/login.html.twig');
    }

    /**
     * @Route("/quote/{id}",name="traitement_devis")
     * @IsGranted("ROLE_COM")
     */
    public function traitementDevis(Quote $quote, EntityManagerInterface $manager)
    {
        $quote->setStatus('en cours');
        $quote->setCommercial($this->getUser());
        $manager->persist($quote);
        $manager->flush();
        return $this->render('quote/show.html.twig', ['quote' => $quote]);
    }


    /**
     * @Route("/quote/cloture/{id}",name="cloture_devis")
     * @IsGranted("ROLE_COM")
     */
    public function clotureDevis(Quote $quote, EntityManagerInterface $manager)
    {
        $quote->setStatus('termine');
        $manager->persist($quote);
        $manager->flush();
        return $this->redirectToRoute('admin_gestion_devis');
    }
}

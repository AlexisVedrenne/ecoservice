<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Repository\ServiceRepository;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/stats/customer", name="stats_customer")
     * @IsGranted("ROLE_ADMIN")
     */
    public function statscustomer()
    {
        return $this->render('admin/statscustomeradmin.html.twig');
    }

    /**
     * @Route("/stats/services", name="stats_services")
     * @IsGranted("ROLE_ADMIN")
     */
    public function statsservices()
    {
        return $this->render('admin/statsservicesadmin.html.twig');
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
     * @IsGranted("ROLE_ADMIN")
     */
    public function indexquotemanagement()
    {
        return $this->render('admin/quotesmanagement.html.twig');
    }

    /**
     * @Route("/login", name="login")
     */
    public function adminLogin()
    {
        return $this->render('admin/login.html.twig');
    }
}

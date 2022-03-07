<?php

namespace App\Controller;

use App\Repository\ProductRepository;
use App\Services\FileUploader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin", name="admin_")
 */
class AdminController extends AbstractController
{
    /**
     * @Route("/stats/customer", name="stats_customer")
     */
    public function statscustomer()
    {
        return $this->render('admin/statscustomeradmin.html.twig');
    }

    /**
     * @Route("/stats/services", name="stats_services")
     */
    public function statsservices()
    {
        return $this->render('admin/statsservicesadmin.html.twig');
    }

    /**
     * @Route("/manager/product", name="gestion_produit")
     */
    public function indexproductmanagement(ProductRepository $repo, FileUploader $fileUploader)
    {
        return $this->render('admin/productmanagement.html.twig', ['products' => $repo->findAll(), 'file' => $fileUploader]);
    }

    /**
     * @Route("/manager/services", name="gestion_services")
     */
    public function indexservicesmanagement()
    {
        return $this->render('admin/servicesmanagement.html.twig');
    }

    /**
     * @Route("/manager/quotes", name="gestion_devis")
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

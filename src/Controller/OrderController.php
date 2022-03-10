<?php

namespace App\Controller;
use App\Entity\Product;
use App\Entity\User;
use App\Repository\CategoryProductRepository;
use App\Repository\OrderRepository;
use App\Repository\ProductRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\Id;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class OrderController extends AbstractController
{
    /**
     * @Route("/order", name="app_order")
     */
    public function index()
    {
        
        
        $user = $this->getUser();
        
        //$this->getUser()->$this->orders;
        $orders= $user->getOrders();
        
        
        
        //echo($orders);
        //dump($orders);
        return $this->render('order/index.html.twig', ['orders' => $orders ] );
        
    }
}

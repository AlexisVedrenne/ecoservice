<?php

namespace App\Controller;

use App\Entity\Product;
use App\Entity\Order;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;

/**
 * @Route("/cart", name="cart_")
 */
class CartController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(SessionInterface $session, ProductRepository $productRepository, Request $request, EntityManagerInterface $entityManager)
    {
        $panier = $session->get("panier", []);
        //on fabrique les données
        $dataPanier = [];
        $total = 0;

        foreach ($panier as $id => $quantite) {
            $product = $productRepository->find($id);
            $tempObj = [
                "produit" => $product,
                "quantite" => $quantite
            ];
            array_push($dataPanier, (object)$tempObj);
            $total += $product->getPrice() * $quantite;
        }



        if ($request->isMethod('POST')) {


            $token = $request->request->get('stripeToken');
            \Stripe\Stripe::setApiKey("sk_test_51KabbgBf0vZfGc8SGE7gCsIGarhN0cXyCydjTCCZHNO3YbyFyGg9We8v6FRkaPpUUzT5brfSzYdio5SNQSEJhjn400qXPy0NXW");
            \Stripe\Charge::create(array(
                "amount" => $total * 100,
                "currency" => "eur",
                "source" => $token,
                "description" => "First test charge!",

            ));
            $session->remove("panier");
            $order = new Order();
            foreach ($dataPanier as $panier) {
                $panier->produit->setQuantity($panier->produit->getQuantity() - $panier->quantite);
                if ($panier->produit->getQuantity() <= 0) {
                    $panier->produit->setState(false);
                }
                $order->addProduct($panier->produit);
                $order->setQuantity($order->getQuantity() + $panier->quantite);
            }
            $order->setTotal($total);
            $order->setDate(new DateTime('NOW'));
            $entityManager->persist($order);
            $entityManager->flush();
            $this->addFlash('success', 'Commande validé');
            return $this->render('payment/success.html.twig', compact("dataPanier", "total"));
        }
        return $this->render('cart/shoppingcart.html.twig', compact("dataPanier", "total"));
    }

    /**
     * @Route("/add/{id}", name="add")
     * @Route("add/cata/{id}" ,name="add_cata")
     * @Route("add/show/{id}",name="add_show")
     */
    public function add(Product $product, SessionInterface $session, Request $request)
    {
        //on récupére le panier actuel
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if (!empty($panier[$id])) {
            $panier[$id]++;
        } else {
            $panier[$id] = 1;
        }
        //on sauvegarde dans la session 
        $session->set("panier", $panier);
        $tempRoute = $request->attributes->get('_route');
        if ($tempRoute == 'cart_add') {
            return $this->redirectToRoute('cart_index');
        } else if ($tempRoute == 'cart_add_show') {
            return $this->redirectToRoute('product_show', ['id' => $product->getId()]);
        } else {
            return $this->redirectToRoute('product_index');
        }
    }

    /**
     * @Route("/remove/{id}", name="remove")
     */
    public function remove(Product $product, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if (!empty($panier[$id])) {
            if ($panier[$id] > 1) {
                $panier[$id]--;
            } else {
                unset($panier[$id]);
            }
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete(Product $product, SessionInterface $session)
    {
        // On récupère le panier actuel
        $panier = $session->get("panier", []);
        $id = $product->getId();

        if (!empty($panier[$id])) {
            unset($panier[$id]);
        }

        // On sauvegarde dans la session
        $session->set("panier", $panier);

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/delete", name="delete_all")
     */
    public function deleteAll(SessionInterface $session)
    {
        $session->remove("panier");

        return $this->redirectToRoute("cart_index");
    }

    /**
     * @Route("/checkout", name="checkout")
     */
    public function checkout(Request $request, SessionInterface $session): Response
    {

        if ($request->isMethod('POST')) {

            $token = $request->request->get('stripeToken');
            \Stripe\Stripe::setApiKey("sk_test_51KabbgBf0vZfGc8SGE7gCsIGarhN0cXyCydjTCCZHNO3YbyFyGg9We8v6FRkaPpUUzT5brfSzYdio5SNQSEJhjn400qXPy0NXW");
            \Stripe\Charge::create(array(
                "amount" => 110,
                "currency" => "eur",
                "source" => $token,
                "description" => "Eco Service"
            ));
            $this->addFlash('success', 'Order Complete! Yay!');
            $session->remove("panier");
            return $this->redirectToRoute('home');
        }
        return $this->render('cart/index.html.twig', array());
    }
}

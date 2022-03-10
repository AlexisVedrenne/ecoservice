<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Quote;
use App\Form\QuoteType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use DateTime;
use App\Services\HtmlToPdf;

class QuoteController extends AbstractController
{
    /**
     * @Route("/quote", name="app_quote")
     */
    public function index(EntityManagerInterface $manager, Request $request)
    {
        $quote = new Quote();
        $form = $this->createForm(QuoteType::class, $quote);
        $form->handleRequest($request);
        $total = 0;
        if ($form->isSubmitted() && $form->isValid()) {
            foreach ($quote->getService() as $service) {
                $total = $total + ($service->getPrice() * 0.2) + $service->getPrice();
            }
            $quote->setDateQuote((new DateTime('NOW'))->format('Y-m'));
            $quote->setTotalPrice($total);
            $quote->setStatus('new');
            $manager->persist($quote);
            $manager->flush();
            return $this->render('quote/devis.html.twig', ['quote' => $quote]);
        }
        return $this->render('quote/index.html.twig', ['form' => $form->createView()]);
    }
}

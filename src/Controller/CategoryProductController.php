<?php

namespace App\Controller;

use App\Entity\CategoryProduct;
use App\Form\CategoryProductType;
use App\Repository\CategoryProductRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/category/product")
 */
class CategoryProductController extends AbstractController
{
    /**
     * @Route("/", name="category_product_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(CategoryProductRepository $categoryProductRepository): Response
    {
        return $this->render('category_product/index.html.twig', [
            'category_products' => $categoryProductRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="category_product_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categoryProduct = new CategoryProduct();
        $form = $this->createForm(CategoryProductType::class, $categoryProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categoryProduct);
            $entityManager->flush();

            return $this->redirectToRoute('category_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category_product/new.html.twig', [
            'category_product' => $categoryProduct,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="category_product_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, CategoryProduct $categoryProduct, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryProductType::class, $categoryProduct);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('category_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category_product/edit.html.twig', [
            'category_product' => $categoryProduct,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="category_product_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, CategoryProduct $categoryProduct, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $categoryProduct->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categoryProduct);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_product_index', [], Response::HTTP_SEE_OTHER);
    }
}

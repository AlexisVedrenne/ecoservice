<?php

namespace App\Controller;

use App\Entity\Commentary;
use App\Entity\Product;
use App\Form\ProductType;
use App\Repository\CategoryProductRepository;
use App\Repository\CommentaryRepository;
use App\Repository\ProductRepository;
use App\Services\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;


/**
 * @Route("/product")
 */
class ProductController extends AbstractController
{
    /**
     * @Route("/", name="product_index")
     */
    public function index(ProductRepository $productRepository, CategoryProductRepository $repoCat): Response
    {
        return $this->render('product/index.html.twig', [
            'products' => $productRepository->findAll(), 'cats' => $repoCat->findAll()
        ]);
    }

    /**
     * @Route("/new", name="product_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $images = $form->get('image')->getData();
            if ($images) {
                foreach ($images as $img) {
                    $tempFileName = $fileUploader->upload($img);
                    $product->addImages($tempFileName);
                }
            }
            $entityManager->persist($product);
            $entityManager->flush();

            return $this->redirectToRoute('admin_gestion_produit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product/new.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/show/{id}", name="product_show", methods={"GET"})
     */
    public function show(Product $product, CommentaryRepository $commentaryRepository): Response
    {
        return $this->render('product/show.html.twig', [
            'product' => $product,'commentarys' => $commentaryRepository->findBy(array('product' => $product)),
        ]);
    }

    /**
     * @Route("/edit/{id}", name="product_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, Product $product, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $images = $form->get('image')->getData();
            if ($images) {
                foreach ($images as $img) {
                    $tempFileName = $fileUploader->upload($img);
                    $product->addImages($tempFileName);
                }
            }
            $entityManager->flush();

            return $this->redirectToRoute('admin_gestion_produit', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('product/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="product_delete")
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Product $product, EntityManagerInterface $entityManager): Response
    {
        foreach ($product->getImages() as $img) {
            unlink('assets/uploads/' . $img);
        }
        $entityManager->remove($product);
        $entityManager->flush();
        return $this->redirectToRoute('admin_gestion_produit', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/delete/img/{id}/{imgVal}", name="product_img")
     */
    public function deleteImg(Product $product, string $imgVal, EntityManagerInterface $entityManager)
    {
        $images = $product->getImages();
        $cpt = 0;
        foreach ($product->getImages() as $img) {
            if ($img == $imgVal) {
                unset($images[$cpt]);
                $product->resetImg($images);
                $entityManager->persist($product);
                $entityManager->flush();
                unlink('assets/uploads/' . $img);
                return $this->redirectToRoute('admin_gestion_produit', [], Response::HTTP_SEE_OTHER);
            }
            $cpt = $cpt + 1;
        }
        return $this->redirectToRoute('admin_gestion_produit', [], Response::HTTP_SEE_OTHER);
    }
}

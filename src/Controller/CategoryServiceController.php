<?php

namespace App\Controller;

use App\Entity\CategoryService;
use App\Form\CategoryServiceType;
use App\Repository\CategoryServiceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

/**
 * @Route("/category/service")
 */
class CategoryServiceController extends AbstractController
{
    /**
     * @Route("/", name="category_service_index", methods={"GET"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function index(CategoryServiceRepository $categoryServiceRepository): Response
    {
        return $this->render('category_service/index.html.twig', [
            'category_services' => $categoryServiceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="category_service_new", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $categoryService = new CategoryService();
        $form = $this->createForm(CategoryServiceType::class, $categoryService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($categoryService);
            $entityManager->flush();

            return $this->redirectToRoute('category_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category_service/new.html.twig', [
            'category_service' => $categoryService,
            'form' => $form,
        ]);
    }


    /**
     * @Route("/{id}/edit", name="category_service_edit", methods={"GET", "POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function edit(Request $request, CategoryService $categoryService, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CategoryServiceType::class, $categoryService);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('category_service_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('category_service/edit.html.twig', [
            'category_service' => $categoryService,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="category_service_delete", methods={"POST"})
     * @IsGranted("ROLE_ADMIN")
     */
    public function delete(Request $request, CategoryService $categoryService, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $categoryService->getId(), $request->request->get('_token'))) {
            $entityManager->remove($categoryService);
            $entityManager->flush();
        }

        return $this->redirectToRoute('category_service_index', [], Response::HTTP_SEE_OTHER);
    }
}

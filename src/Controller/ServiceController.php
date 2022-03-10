<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use App\Repository\ServiceRepository;
use App\Services\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Quote;
use App\Form\ServiceFormType;


/**
 * @Route("/service")
 */
class ServiceController extends AbstractController
{
    /**
     * @Route("/", name="service_index")
     */
    public function index(ServiceRepository $serviceRepository): Response
    {
        return $this->render('service/servicescatalogue.html.twig', [
            'services' => $serviceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="service_new")
     */
    public function new(Request $request, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $service = new Service();
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                $tempFileName = $fileUploader->upload($image);
                $service->setImage($tempFileName);
            }
            $entityManager->persist($service);
            $entityManager->flush();

            return $this->redirectToRoute('admin_gestion_services', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service/new.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/show/{id}", name="service_show")
     */
    public function show(Service $service): Response
    {
        return $this->render('service/detailservices.html.twig', [
            'service' => $service,
        ]);
    }

    /**
     * @Route("/edit/{id}", name="service_edit")
     */
    public function edit(Request $request, Service $service, EntityManagerInterface $entityManager, FileUploader $fileUploader): Response
    {
        $form = $this->createForm(ServiceType::class, $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $image = $form->get('image')->getData();
            if ($image) {
                unlink('assets/uploads/' . $service->getImage());
                $tempFileName = $fileUploader->upload($image);
                $service->setImage($tempFileName);
            }
            $entityManager->flush();
            return $this->redirectToRoute('admin_gestion_services', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('service/edit.html.twig', [
            'service' => $service,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/delete/{id}", name="service_delete")
     */
    public function delete(Request $request, Service $service, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($service);
        $entityManager->flush();
        unlink('assets/uploads/' . $service->getImage());
        return $this->redirectToRoute('admin_gestion_services', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/form", name="service_form")
     */
    public function form(Request $request): Response
    {
        $quote =[];
        $form = $this ->createForm(ServiceFormType::class,$quote );
        $form->handleRequest($request);

        if( $form->isSubmitted() && $form->isValid() ) {
            
            // TO DO capture and transform the data into a PDF file.
        }

        return $this->render('service/service_form.html.twig', [
            'service' => $form->createView(),
        ]);

    }
}

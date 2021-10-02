<?php

namespace App\Controller\Admin;

use App\Entity\Admin\Footer;
use App\Entity\Admin\Parameter;
use App\Form\Admin\FooterType;
use App\Repository\Admin\FooterRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin/footer")
 */
class FooterController extends AbstractController
{
    /**
     * @Route("/", name="admin_footer_index", methods={"GET"})
     */
    public function index(FooterRepository $footerRepository): Response
    {
        return $this->render('admin/footer/index.html.twig', [
            'footers' => $footerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/", name="admin_footer_index", methods={"GET"})
     */
    public function footers(FooterRepository $footerRepository): Response
    {
        $parameter = $this->getDoctrine()->getRepository(Parameter::class)->find(1);
        $footers = $this->getDoctrine()->getRepository(Footer::class)->findAll();

        return $this->render('admin/footer/footer.html.twig', [
            'footers' => $footers,
            'parameter' => $parameter
        ]);
    }

    /**
     * @Route("/new", name="admin_footer_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $footer = new Footer();
        $form = $this->createForm(FooterType::class, $footer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($footer);
            $entityManager->flush();

            return $this->redirectToRoute('admin_footer_index');
        }

        return $this->render('admin/footer/new.html.twig', [
            'footer' => $footer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_footer_show", methods={"GET"})
     */
    public function show(Footer $footer): Response
    {
        return $this->render('admin/footer/show.html.twig', [
            'footer' => $footer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin_footer_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Footer $footer): Response
    {
        $form = $this->createForm(FooterType::class, $footer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_footer_index');
        }

        return $this->render('admin/footer/edit.html.twig', [
            'footer' => $footer,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin_footer_delete", methods={"POST"})
     */
    public function delete(Request $request, Footer $footer): Response
    {
        if ($this->isCsrfTokenValid('delete'.$footer->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($footer);
            $entityManager->flush();
        }

        return $this->redirectToRoute('admin_footer_index');
    }
}

<?php

namespace App\Controller\GestApp;

use App\Entity\GestApp\ProductCategory;
use App\Form\GestApp\ProductCategoryType;
use App\Repository\GestApp\ProductCategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class ProductCategoryController extends AbstractController
{
    /**
     * @Route("/gestapp/product/category/", name="op_gestapp_product_category_index", methods={"GET"})
     */
    public function index(ProductCategoryRepository $productCategoryRepository): Response
    {
        return $this->render('gest_app/product_category/index.html.twig', [
            'product_categories' => $productCategoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/gestapp/product/category/new", name="op_gestapp_product_category_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
        if(!$data){
            $productCategory = new ProductCategory();
            $form = $this->createForm(ProductCategoryType::class, $productCategory);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($productCategory);
                $entityManager->flush();

                $category = $productCategory->getName();

                return $this->json([
                    'code'=> 200,
                    'category' => $category,
                    'message' => "Une catégorie a été ajoutée."
                ], 200);
            }

            return $this->render('gest_app/product_category/new.html.twig', [
                'product_category' => $productCategory,
                'form' => $form->createView(),
            ]);
        }
        else {
            $name = $data['name'];
            $productCategory = new ProductCategory();
            $productCategory->setName($data['name']);
            $productCategory->setNature($data['nature']);
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($productCategory);
            $entityManager->flush();

            $category = $productCategory->getName();

            return $this->json([
                'code' => 200,
                'category' => $category,
                'message' => "Une catégorie a été ajoutée."
            ], 200);
        }
    }

    /**
     * @Route("/gestapp/product/category/{id}", name="op_gestapp_product_category_show", methods={"GET"})
     */
    public function show(ProductCategory $productCategory): Response
    {
        return $this->render('gest_app/product_category/show.html.twig', [
            'product_category' => $productCategory,
        ]);
    }

    /**
     * @Route("/gestapp/product/category/{id}/edit", name="op_gestapp_product_category_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, ProductCategory $productCategory): Response
    {
        $form = $this->createForm(ProductCategoryType::class, $productCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('gest_app_product_category_index');
        }

        return $this->render('gest_app/product_category/edit.html.twig', [
            'product_category' => $productCategory,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/gestapp/product/category/{id}", name="op_gestapp_product_category_delete", methods={"POST"})
     */
    public function delete(Request $request, ProductCategory $productCategory): Response
    {
        if ($this->isCsrfTokenValid('delete'.$productCategory->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($productCategory);
            $entityManager->flush();
        }

        return $this->redirectToRoute('gest_app_product_category_index');
    }
}

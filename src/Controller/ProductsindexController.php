<?php

namespace App\Controller;


use App\bundleoverwritten\HtmlbuttonColumn;
use App\bundleoverwritten\HtmlcolorColumn;
use App\Entity\Products;
use App\Form\ProductType;
use Omines\DataTablesBundle\Column\DateTimeColumn;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Column\TextColumn;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;

class ProductsindexController extends AbstractController
{

    protected $datatableFactory;
    public function __construct(DataTableFactory $datatableFactory) {
        $this->datatableFactory = $datatableFactory;
    }


    /**
     * @Route("/productsindex", name="productsindex")
     */




    public function index(Request $request)
    {
        /*/ Find Products in Database /*/
        $product = $this->getDoctrine()
            ->getRepository(Products::class)
            ->findAll();
        if (!$product) {
            throw $this->createNotFoundException(
                'No products found in this Table.'
            );
        }

        /*/ Only Show Table if found datas in the table products /*/
        if ($product) {
            /*/ Create the Table /*/
            $table = $this->datatableFactory->create([])
                ->add('location', TextColumn::class, ['label' => 'location', 'searchable' => true])
                ->add('type', TextColumn::class, ['label' => 'Type', 'searchable' => true])
                ->add('device_health', TextColumn::class, ['label' => 'Device health', 'searchable' => true])
                ->add('last_used', DateTimeColumn::class, ['label' => 'last_used', 'searchable' => true])
                ->add('price', TextColumn::class, ['label' => 'price', 'searchable' => true])
                ->add('color', HtmlcolorColumn::class, [

                    'label' => 'color',

                ])
                ->add('id', HtmlbuttonColumn::class, [
                    'className' => 'buttons ',
                    'label' => 'actions',


                ])
                ->createAdapter(ORMAdapter::class, [
                    'entity' => Products::class,
                ])
                ->handleRequest($request);
        }

        if ($table->isCallback()) {

            return $table->getResponse();
        }

        /*/ Install $form_view /*/
        $form_view = "";

        /*/ for new entries form /*/
        $em = new Products();

        if ($request->query->get('edit')) {

            
        }
        /*/ Form Create /*/
        if ($em) {
            $form = $this->createForm(ProductType::class, $em);
            $form_view = $form->createView();
        }

        /*/ Update Data by id /*/
        if ($request->query->get('edit')) {
            $update = $this->getDoctrine()->getManager();
            $product_update =$update->getRepository(Products::class)->findBy($request->query->get('edit'));
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {

                $update->flush();

                return $this->redirectToRoute('productsindex');
            }
        }




        return $this->render('productsindex/index.html.twig', [
            'controller_name' => 'ProductsindexController',
            'datatable' => $table,
            'form' => $form_view
        ]);
    }
}

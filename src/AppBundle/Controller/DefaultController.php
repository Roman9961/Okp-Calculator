<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\ProductType;
use CoreBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{

    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
       $product = $em->getRepository('CoreBundle:Product')->findOneBy(['id'=>1]);

        $form = $this->createForm(ProductType::class, $product);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            /**
             * @var Product $productProperties
             */
            $productProperties = $form->getViewData();

            $sideA = $productProperties->getPrintings()->getSideA();
            $sideB = $productProperties->getPrintings()->getSideB();

            $paperPrice = $productProperties->getPapers()->getPrice();

            $printPrice = $sideA->getPrice()
                        + $sideB = $sideB?$sideB->getPrice():0;

            $total = ($paperPrice+$printPrice)*$productProperties->getCount();

            if($request->isXmlHttpRequest()){
                return new JsonResponse($total);
            }

        }
        return $this->render('@App/Default/index.html.twig', [
            'form' => $form->createView(),
            'name'=>$product->getName()
        ]);
    }
}

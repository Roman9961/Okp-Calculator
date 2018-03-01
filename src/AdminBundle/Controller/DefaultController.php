<?php

namespace AdminBundle\Controller;

use AdminBundle\Form\Type\ProductType;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends BaseController
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $product = $em->getRepository('CoreBundle:Product')->findAll();
//        $print = $repo('CoreBundle:Product')->fin;
        return $this->render('@Admin/Default/index.html.twig', [
            'product' => $product
        ]);
    }
}

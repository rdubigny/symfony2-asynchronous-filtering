<?php

namespace StoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

class ProductController extends Controller
{
    /**
     * @param Request $request
     * @return array
     * @Route("/product")
     * @Template()
     */
    public function listAction(Request $request)
    {
//        $productList = $this->container->get('store.product.repository')->findAll();
        $productSearchType = $this->get('store.form.type.product_search');

        $form = $this->createForm($productSearchType);
        $form->handleRequest($request);

        $data = $form->isValid() ? $form->getData() : $data = array();

        $productList = $this->container->get('store.product.repository')->findByMultiple($data);

        return array(
            'productList' => $productList,
            'form' => $form->createView()
        );
    }

    /**
     * @Route("/product-partial")
     * @Template()
     */
    public function listPartialAction()
    {
        return array(
                // ...
            );
    }
}

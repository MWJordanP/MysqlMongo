<?php

namespace MongoBundle\Controller;

use MongoBundle\Document\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/***
 * Class DefaultController
 */
class DefaultController extends Controller
{
    /**
     * @Route("/", name="mongo")
     */
    public function indexAction()
    {
        $product = new Product();
        $product->setName('A Foo Bar');
        $product->setPrice('19.99');

        $dm = $this->get('doctrine_mongodb')->getManager();
        $dm->persist($product);
        $dm->flush();

        dump($product);exit;

        return $this->render('MongoBundle:Default:index.html.twig');
    }
}

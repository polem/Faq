<?php

namespace Yoopies\FaqBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        $categories = $this->get('category.repository')->findAll();

        return $this->render('FaqBundle:Default:index.html.twig', [
            'categories' => $categories,
        ]);
    }
}

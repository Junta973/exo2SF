<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{

    /**
     * @Route("/", name="Home")
     */
    public function home()
    {
        //Je demande de la renvoyer à ma vue
        return $this->render('base.html.twig');
    }
}
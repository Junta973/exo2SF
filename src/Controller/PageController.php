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
        dump("Vous sur la home page"); die;
    }
}
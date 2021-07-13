<?php


namespace App\Controller\front;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FrontCategoriesController extends AbstractController
{

    /**Création de la première route*/
    /**
     * @Route ("/categories", name="categories")
     */
    public function categorieList(CategoryRepository $categoryRepository)
    {
        // Je fais ma requete sql
        $categories = $categoryRepository->findAll();

        return $this->render('front/categorie_list.html.twig', [
            'categories' => $categories
        ]);
    }


    /**Création de la seconde route pour afficher une seule categorie*/
    /**
     * @Route("/categories/{id}", name="categorie_show")
     */
    public function categorieShow($id, CategoryRepository $categoryRepository)
    {

        // afficher un article en fonction de l'id renseigné dans l'url (en wildcard) avec la requete sql
        $categories= $categoryRepository->find($id);

        return $this->render('front/categorie_show.html.twig', [
            'categorie' => $categories
        ]);
    }
}


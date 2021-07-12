<?php


namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    /**
     * @Route("/categories/insert", name="categorieInsert")
     */
    public function insertCategorie()
    {
        //J'utilise l'entité Categorie, pour créer une nouvelle categorie en BDD
        //une instance de l'entité Categorie = un enregistrement de categorie en BDD
        $categorie = new Category()
    }



    /**Création de la première route*/
    /**
     * @Route ("/categories", name="categories")
     */
    public function categorieList(CategoryRepository $categoryRepository)
    {
        // Je fais ma requete sql
        $categories = $categoryRepository->findAll();

        return $this->render('categoriesList.html.twig', [
            'categories' => $categories
        ]);
    }


    /**Création de la seconde route pour afficher un seul article*/
    /**
     * @Route("/categories/{id}", name="categorieShow")
     */
    public function categorieShow($id, CategoryRepository $categoryRepository)
    {

        // afficher un article en fonction de l'id renseigné dans l'url (en wildcard) avec la requete sql
        $categories= $categoryRepository->find($id);

        return $this->render('categorieShow.html.twig', [
            'categorie' => $categories
        ]);
    }
}


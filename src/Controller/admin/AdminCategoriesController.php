<?php


namespace App\Controller\admin;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminCategoriesController extends AbstractController
{
    /**
     * @Route("/categories/insert", name="categorie_insert")
     */
    public function insertCategorie(EntityManagerInterface $entityManager)
    {
        //J'utilise l'entité Categorie, pour créer une nouvelle categorie en BDD
        //une instance de l'entité Categorie = un enregistrement de categorie en BDD
        $categorie = new Category();

        //j'utilise les setter de l'entité Category pour renseigner les valeurs des colonnes
        $categorie->setTitle('Immobilier');
        $categorie->setDescription('Liste tout les articles immobilier');

        //je prend toutes les entités créées (ici une seule) et je les pré-sauvegarde
        $entityManager->persist($categorie);

        //je recupère toute les entités pré-sauvegardé et je les insère en BDD
        $entityManager->flush();

        //Je créer un dump pour vérifier mon retour, on peut ausssi renvoyer vers un twig pour
        //afficher ce que l'on a inseré.
        //Penser a vérifier en BDD que l'insertion s'est bien déroulé

        return $this->render('admin/admin_categorie_list.html.twig', [
            'categories' => $categories
        ]);
    }


    /**Création de la première route*/
    /**
     * @Route ("/admin/categories", name="admin_categories")
     */
    public function categorieList(CategoryRepository $categoryRepository)
    {
        // Je fais ma requete sql
        $categories = $categoryRepository->findAll();

        //Je demande de la renvoyer à ma vue
        return $this->render('admin/admin_categorie_list.html.twig', [
            'categories' => $categories
        ]);
    }

}


<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
private $categories = [
    1 => [
        "title" => "Politique",
        "content" => "Tous les categorie liés à Jean Lassalle",
        "id" => 1,
        "published" => true,
    ],
    2 => [
        "title" => "Economie",
        "content" => "Les meilleurs tuyaux pour avoir DU FRIC",
        "id" => 2,
        "published" => true
    ],
    3 => [
        "title" => "Securité",
        "content" => "Attention les étrangers sont très méchants",
        "id" => 3,
        "published" => false
    ],
    4 => [
        "title" => "Ecologie",
        "content" => "Hummer <3",
        "id" => 4,
        "published" => true
    ]
    ];

    /**Création de la première route*/
    /**
     * @Route ("/categories", name="categories")
     */
    public function categorieList()
    {
        return $this->render('categoriesList.html.twig', [
            'categories' => $this->categories
        ]);
    }


    /**Création de la seconde route pour afficher un seul article*/
    /**
     * @Route("/categories/{id}", name="categorieShow")
     */
    public function categorieShow($id)
    {
        // j'utilise la méthode render de l'AbstractController
        // pour récupérer un fichier Twig, le transformer en HTML
        // et le renvoyer en réponse HTTP au navigateur
        // Pour utiliser des variables dans le fichier twig, je dois
        // lui passer un tableau en second parametre, avec toutes les
        // variables que je veux utiliser
        return $this->render('categorieShow.html.twig', [
            'categorie' => $this->categories[$id]
        ]);
    }
}


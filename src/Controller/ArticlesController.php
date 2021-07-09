<?php


namespace App\Controller;


use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="articlesList")
     */
    public function articlesView (ArticleRepository $articleRepository)
    {
        // Je fais ma requete sql
        $articles = $articleRepository->findAll();

        //Je demande de la renvoyer à ma vue
        return $this->render('articlesList.html.twig',[
            'articles'=>$articles
        ]);
    }


    /**
     * @Route("/articles/{id}", name="articleView")
     */
    public function article($id, ArticleRepository $articleRepository)
    {

        // afficher un article en fonction de l'id renseigné dans l'url (en wildcard) avec la requete sql
        $article = $articleRepository->find($id);

        //Je renvoie à ma vue
        return $this->render('articleView.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * @Route("/search", name="search")
     */
    public function search(ArticleRepository $articleRepository,Request $request)
    {
        // représente le mot taper dans le formulaire
        $term = $request->query->get('q');


        // renvoie vers la requete SQL que l'on a crée dans ArticleRepository
        // en fonction du mot taper dans le formulaire
        $articles = $articleRepository->searchByTerm($term);

        return $this->render('article_search.html.twig', [
            'articles'=>$articles,
            'term'=>$term
        ]);


    }
}
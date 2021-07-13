<?php


namespace App\Controller\front;


use App\Entity\Article;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FrontArticlesController extends AbstractController
{

    /**
     * @Route("/articles", name="article_list")
     */
    public function articlesView (ArticleRepository $articleRepository)
    {
        // Je fais ma requete sql
        $articles = $articleRepository->findAll();

        //Je demande de la renvoyer à ma vue
        return $this->render('front/article_list.html.twig',[
            'articles'=>$articles
        ]);
    }


    /**
     * @Route("/articles/{id}", name="article_view")
     */
    public function article($id, ArticleRepository $articleRepository)
    {

        // afficher un article en fonction de l'id renseigné dans l'url (en wildcard) avec la requete sql
        $article = $articleRepository->find($id);

        //Je renvoie à ma vue
        return $this->render('front/article_view.html.twig', [
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

        return $this->render('front/article_search.html.twig', [
            'articles'=>$articles,
            'term'=>$term
        ]);

    }
}
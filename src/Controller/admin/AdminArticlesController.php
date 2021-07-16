<?php


namespace App\Controller\admin;


use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class AdminArticlesController extends AbstractController
{
    //correspond au create du crud en dur
    /**
     * @Route("/admin/articles/static/insert", name="admin_article_static_insert")
     */
    public function insertArticle(EntityManagerInterface $entityManager)
    {
        //j'utilise l'entité Article, pour créer un nouvel article en BDD
        //une instance de l'entité Article = un enregistrement en BDD
        $article = new Article ();

        //j'utilise les setters de l'entité Article pour renseigner les valeurs des colonnnes
        $article->setTitle('Tik Tok ou la dechance des jeunes');
        $article->setContent('On peut dire que les jeunes sont vraiment mais vraiment dans la merde');
        $article->setIspublished(true);
        $article->setCreatedAt(new \DateTime('NOW'));

        //je prends toutes les entités crées(ici une seule) et je les pré-sauvegarde
        $entityManager->persist($article);

        //je récupère toutes les entités pré-sauvegardé et je les insère en BDD
        $entityManager->flush();

        return $this->redirectToRoute('admin_article_list');
    }

    //correspond au create du crud par formulaire
    /**
     * @Route("/admin/articles/insert", name="admin_article_insert")
     */
    public function insertArticleViaForm(Request $request,EntityManagerInterface $entityManager)
    {
        $article = new Article();

        // on génère le formulaire en utilisant le gabarit + une instance de l'entité Article
        $articleform = $this->createForm(ArticleType::class,$article);

        // on lie le formulaire aux données de POST (aux données envoyées en POST)
        $articleform->handleRequest($request);

        // si le formulaire a été posté et qu'il est valide (que tous les champs
        // obligatoires sont remplis correctement), alors on enregistre l'article
        //crééé en BDD
        if($articleform->isSubmitted() && $articleform->isValid()){
            $entityManager->persist($article);
            $entityManager->flush();

            //Stock un message flash et l'affichera sur la prochaine page
            $this->addFlash('success', 'Article Created! Votre article '. $article->getTitle().' a bien été ajouté!');

            return $this->redirectToRoute('admin_article_list');
        }

        return $this->render('admin/admin_insert.article.html.twig',[
            'articleForm'=> $articleform->createView()
        ]);

    }

    //Correspond a l'update/modification du crud
    /**
     * @Route("/admin/articles/static/update/{id}", name="admin_article_static_update")
     */
    public function updateArticle($id,EntityManagerInterface $entityManager,ArticleRepository $articleRepository)
    {
        $article = $articleRepository->find($id);

        $article->setTitle("Je modifie le titre");
        $entityManager->persist($article);
        $entityManager->flush($article);

        return $this->redirectToRoute("admin_article_list");
    }


    //Correspond a l'update via formulaire/modification du crud
    /**
     * @Route("/admin/articles/update/{id}", name="admin_article_update")
     */
    public function updateArticleViaForm($id,EntityManagerInterface $entityManager,
                                         ArticleRepository $articleRepository, Request $request)
    {
        //pour insérer un article : $article = new Article ();
        $article = $articleRepository->find($id);

        //On génère le formulaire en utlisant le gabarit + une instance de l'entité Article
        $articleform = $this->createForm(ArticleType::class,$article);

        //On lie le formulaire au donnée de POST (aux donnée envoyé en POST)
        $articleform->handleRequest($request);

        // si le formulaire a été posté et qu'il est valide (que tous les champs
        // obligatoires sont remplis correctement), alors on enregistre l'article
        // créé en bdd
        if ($articleform->isSubmitted() && $articleform->isValid()){
                $entityManager->persist($article);
                $entityManager->flush();

                //Stock un message flash et l'affichera sur la prochaine page
                $this->addFlash('success', 'Article Updated! Votre article '. $article->getTitle().' a bien été modifié!');

                return $this->redirectToRoute('admin_article_list');
        }

        return $this->render('admin/admin_insert.article.html.twig', [
            'articleForm'=> $articleform->createView()
        ]);
    }

    //Correspond au delete/suppression du crud
    /**
     * @Route("/admin/articles/delete/{id}",name="admin_article_delete")
     */
    public function deleteArticle ($id,EntityManagerInterface $entityManager,ArticleRepository $articleRepository)
    {
        $article = $articleRepository->find($id);

        $entityManager->remove($article);
        $entityManager->flush();

        //Stock un message flash et l'affichera sur la prochaine page
        $this->addFlash('success', 'Article Deleted! Votre article '. $article->getTitle().' a bien été supprimé!');

        return $this->redirectToRoute("admin_article_list");
    }


    //Correspond à la page liste des articles
    /**
     * @Route("/admin/articles", name="admin_article_list")
     */
    public function articlesList (ArticleRepository $articleRepository)
    {
        // Je fais ma requete sql
        $articles = $articleRepository->findAll();

        //Je demande de la renvoyer à ma vue
        return $this->render('admin/admin_article_list.html.twig',[
            'articles'=>$articles
        ]);
    }


}
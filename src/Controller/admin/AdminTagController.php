<?php


namespace App\Controller\admin;


use App\Entity\Tags;
use App\Repository\TagsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class AdminTagController extends AbstractController
{

    //Correspond au create du CRUD pour les Tags
    /**
     * @Route("/admin/tags/insert", name="admin_tag_insert")
     */
    public function createTag(EntityManagerInterface $entityManager,TagsRepository $tagsRepository)
    {
        // J'utilise l'entité Tags, pour créer un nouvel article en bdd
        // une instance de l'entité Tags = un enregistrement d'article en bdd
        $tag = new Tags();

        // j'utilise les setters de l'entité Tags pour renseigner les valeurs des colonnes
        $tag->setTitle('Black Friday');
        $tag->setColor("black");

        //Je sauvegarde les entitées crée
        $entityManager->persist($tag);

        // je récupère toutes les entités pré-sauvegardées et je les insère en BDD
        $entityManager->flush();

        return $this->redirectToRoute("admin_tags_list");

    }


    //Correspond a update du CRUD pour les Tags
    /**
     * @Route("/admin/tags/update/{id}", name="admin_tag_update")
     */
    public function updateTag($id,EntityManagerInterface $entityManager,TagsRepository $tagsRepository)
    {
            $tag = $tagsRepository->find($id);

            $tag->setTitle('Tag modifier');

            $entityManager->persist($tag);
            $entityManager->flush();

        return $this->redirectToRoute("admin_tags_list");
    }


    /**
     * @Route("/admin/tags", name="admin_tags_list")
     */
    public function tagList(TagsRepository $tagsRepository)
    {
        //Je créer ma requête SQL qui me récupère ce qu'il y a dans le Tagsrepository
        $tags = $tagsRepository->findAll();


        //Je renvoie vers ma page tagList les infos récolté
        return $this->render('admin/admin_tags_list.html.twig', [
            'tags' => $tags
        ]);
    }


    /**
     * @Route("/admin/tags/{id}", name="admin_tags_view")
     */
    public function tagsView($id,TagsRepository $tagsRepository)
    {
        //Je créer ma requête SQL qui me récupère l'ID dans le tagRepository
        $tag = $tagsRepository->find($id);

        // si le tag n'a pas été trouvé, je renvoie une exception (erreur)
        // pour afficher une 404
        if (is_null($tag)) {
            throw new NotFoundHttpException();
        }


        // je renvoie à ma page tagsView les infos par rapport à l'ID
        return $this->render('admin/admin_tags_view.html.twig', [
            'tag' => $tag
        ]);

    }



}
<?php


namespace App\Controller\front;


use App\Repository\TagsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Annotation\Route;

class FrontTagController extends AbstractController
{
    /**
     * @Route("/tags", name="tags_list")
     */
    public function tagList(TagsRepository $tagsRepository)
    {
        //Je créer ma requête SQL qui me récupère ce qu'il y a dans le Tagsrepository
        $tags = $tagsRepository->findAll();


        //Je renvoie vers ma page tagList les infos récolté
        return $this->render('front/tags_list.html.twig', [
            'tags' => $tags
        ]);
    }


    /**
     * @Route("/tags/{id}", name="tags_view")
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
        return $this->render('front/tags_view.html.twig', [
            'tag' => $tag
        ]);

    }
}
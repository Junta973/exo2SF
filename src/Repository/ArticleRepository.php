<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }


    //methode que l'on créer pour executer notre propre requete SQL
    public function searchByTerm($term)
    {
        // On créer une variable qui va créer notre requete SQL
        $queryBuilder = $this->createQueryBuilder('article');

        //Notre requete SQL
        $query = $queryBuilder
            ->select('article')
            ->where('article.content LIKE :term')
            ->orWhere('article.title LIKE :term')

            //Protège contre les injections SQL
            ->setParameter('term','%'.$term.'%')

            //Récupère la requete SQL
            ->getQuery();

        return $query->getResult();
    }


}

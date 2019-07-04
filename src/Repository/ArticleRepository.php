<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

     /**
      * @return Article[] Returns an array of Article objects
      */
    public function findAllPublishedOrderedByNewest()
    {
        return $this->addPublishedQueryBuilder()
            ->orderBy('a.published', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function getDqlArticles()
    {
        $dql = 'SELECT a FROM App\Entity\Article a ORDER BY a.published DESC';

        $query = $this->getEntityManager()->createQuery($dql);
        return $query->execute();
    }

    private function addPublishedQueryBuilder(QueryBuilder $qb = null)
    {
        return $this->getOrCreateQueryBuilder($qb)
            ->andWhere('a.published IS NOT NULL');
    }

    private function getOrCreateQueryBuilder(QueryBuilder $qb = null)
    {
        return $qb ?: $this->createQueryBuilder('a');
    }

    /**
     * @return Criteria
     */
    public static function createNonDeletedCriteria()
    {
        return Criteria::create()
            ->andWhere(Criteria::expr()->eq("isDeleted", false))
            ->orderBy(["createdAt" => "desc"]);
    }

    /*
    public function findOneBySomeField($value): ?Article
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

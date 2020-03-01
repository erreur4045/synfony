<?php

namespace App\Repository;

use App\Entity\Videolink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Videolink|null find($id, $lockMode = null, $lockVersion = null)
 * @method Videolink|null findOneBy(array $criteria, array $orderBy = null)
 * @method Videolink[]    findAll()
 * @method Videolink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VideolinkRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Videolink::class);
    }

    // /**
    //  * @return Videolink[] Returns an array of Videolink objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Videolink
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Pictureslink;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Pictureslink|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pictureslink|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pictureslink[]    findAll()
 * @method Pictureslink[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PictureslinkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Pictureslink::class);
    }

    // /**
    //  * @return Pictureslink[] Returns an array of Pictureslink objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Pictureslink
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

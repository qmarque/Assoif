<?php

namespace App\Repository;

use App\Entity\Assoiffe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Assoiffe|null find($id, $lockMode = null, $lockVersion = null)
 * @method Assoiffe|null findOneBy(array $criteria, array $orderBy = null)
 * @method Assoiffe[]    findAll()
 * @method Assoiffe[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssoiffeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assoiffe::class);
    }

    // /**
    //  * @return Assoiffe[] Returns an array of Assoiffe objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Assoiffe
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

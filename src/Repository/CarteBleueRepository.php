<?php

namespace App\Repository;

use App\Entity\CarteBleue;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method CarteBleue|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteBleue|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteBleue[]    findAll()
 * @method CarteBleue[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteBleueRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CarteBleue::class);
    }

    // /**
    //  * @return CarteBleue[] Returns an array of CarteBleue objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CarteBleue
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

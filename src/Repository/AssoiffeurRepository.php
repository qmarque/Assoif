<?php

namespace App\Repository;

use App\Entity\Assoiffeur;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Assoiffeur|null find($id, $lockMode = null, $lockVersion = null)
 * @method Assoiffeur|null findOneBy(array $criteria, array $orderBy = null)
 * @method Assoiffeur[]    findAll()
 * @method Assoiffeur[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssoiffeurRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Assoiffeur::class);
    }

    // /**
    //  * @return Assoiffeur[] Returns an array of Assoiffeur objects
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
    public function findOneBySomeField($value): ?Assoiffeur
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

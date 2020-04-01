<?php

namespace App\Repository;

use App\Entity\Cdc;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Cdc|null find($id, $lockMode = null, $lockVersion = null)
 * @method Cdc|null findOneBy(array $criteria, array $orderBy = null)
 * @method Cdc[]    findAll()
 * @method Cdc[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CdcRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Cdc::class);
    }

    // /**
    //  * @return Cdc[] Returns an array of Cdc objects
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
    public function findOneBySomeField($value): ?Cdc
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

<?php

namespace App\Repository;

use App\Entity\Recettage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Recettage|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recettage|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recettage[]    findAll()
 * @method Recettage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecettageRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recettage::class);
    }

    // /**
    //  * @return Recettage[] Returns an array of Recettage objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recettage
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Renting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Renting|null find($id, $lockMode = null, $lockVersion = null)
 * @method Renting|null findOneBy(array $criteria, array $orderBy = null)
 * @method Renting[]    findAll()
 * @method Renting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Renting::class);
    }

    // /**
    //  * @return Renting[] Returns an array of Renting objects
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
    public function findOneBySomeField($value): ?Renting
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

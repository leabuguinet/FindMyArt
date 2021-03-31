<?php

namespace App\Repository;

use App\Entity\RentingDetail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RentingDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentingDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentingDetail[]    findAll()
 * @method RentingDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentingDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentingDetail::class);
    }

    // /**
    //  * @return RentingDetail[] Returns an array of RentingDetail objects
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
    public function findOneBySomeField($value): ?RentingDetail
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

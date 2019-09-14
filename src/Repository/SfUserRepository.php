<?php

namespace App\Repository;

use App\Entity\User\SfUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method SfUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method SfUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method SfUser[]    findAll()
 * @method SfUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SfUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, SfUser::class);
    }

    // /**
    //  * @return SfUser[] Returns an array of SfUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?SfUser
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

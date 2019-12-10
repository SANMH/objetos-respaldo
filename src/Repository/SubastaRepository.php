<?php

namespace App\Repository;

use App\Entity\Subasta;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Subasta|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subasta|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subasta[]    findAll()
 * @method Subasta[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubastaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subasta::class);
    }

    // /**
    //  * @return Subasta[] Returns an array of Subasta objects
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
    public function findOneBySomeField($value): ?Subasta
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

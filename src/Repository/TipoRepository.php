<?php

namespace App\Repository;

use App\Entity\Tipo;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Tipo|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tipo|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tipo[]    findAll()
 * @method Tipo[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TipoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Tipo::class);
    }

    // /**
    //  * @return Tipo[] Returns an array of Tipo objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Tipo
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

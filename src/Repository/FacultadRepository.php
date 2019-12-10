<?php

namespace App\Repository;

use App\Entity\Facultad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Facultad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Facultad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Facultad[]    findAll()
 * @method Facultad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FacultadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Facultad::class);
    }

    // /**
    //  * @return Facultad[] Returns an array of Facultad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findByTipo($tipo_id)
    {
        return $this->createQueryBuilder('facultad')
            ->andWhere('facultad.tipo = :tipo')
            ->setParameter('tipo', $tipo_id)
            ->orderBy('facultad.name', 'ASC')
            ->getQuery()
            ->getArrayResult()
            ;
    }


    /*
    public function findOneBySomeField($value): ?Facultad
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\RelationType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RelationType|null find($id, $lockMode = null, $lockVersion = null)
 * @method RelationType|null findOneBy(array $criteria, array $orderBy = null)
 * @method RelationType[]    findAll()
 * @method RelationType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RelationTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RelationType::class);
    }

    // /**
    //  * @return RelationType[] Returns an array of RelationType objects
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
    public function findOneBySomeField($value): ?RelationType
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

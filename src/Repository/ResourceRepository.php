<?php

namespace App\Repository;

use App\Entity\Resource;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Resource|null find($id, $lockMode = null, $lockVersion = null)
 * @method Resource|null findOneBy(array $criteria, array $orderBy = null)
 * @method Resource[]    findAll()
 * @method Resource[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ResourceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Resource::class);
    }

    public function recupFavoriteUser(int $user)
    {
        // $dql = "SELECT  FROM favorites f JOIN resource r ON f.resource_id = r.id JOIN user u ON u.id = f.user_id where f.user_id = :user";
        return $this->createQueryBuilder('r')
            ->join("r.Favorite", 'f', 'with f.resource_id = r.id')
            ->Where('f.id = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();
    }

    public function findParentRessource(int $id)
    {

        $qb = $this->createQueryBuilder('r')
            ->join('App\Entity\Comment', 'c', 'with c.resource_id = r.id')
            ->where('c.id = :id')
            ->setParameter('id', $id);

        dd($qb->getQuery());
    }

    // /**
    //  * @return Resource[] Returns an array of Resource objects
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
    public function findOneBySomeField($value): ?Resource
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

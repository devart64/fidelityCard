<?php

namespace App\Repository;

use App\Entity\CarteDeFidelite;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CarteDeFidelite|null find($id, $lockMode = null, $lockVersion = null)
 * @method CarteDeFidelite|null findOneBy(array $criteria, array $orderBy = null)
 * @method CarteDeFidelite[]    findAll()
 * @method CarteDeFidelite[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CarteDeFideliteRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CarteDeFidelite::class);
    }

    // /**
    //  * @return CarteDeFidelite[] Returns an array of CarteDeFidelite objects
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
    public function findOneBySomeField($value): ?CarteDeFidelite
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

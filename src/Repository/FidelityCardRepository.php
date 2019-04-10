<?php

namespace App\Repository;

use App\Entity\FidelityCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method FidelityCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method FidelityCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method FidelityCard[]    findAll()
 * @method FidelityCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FidelityCardRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, FidelityCard::class);
    }

    // /**
    //  * @return FidelityCard[] Returns an array of FidelityCard objects
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

    /*
    public function findOneBySomeField($value): ?FidelityCard
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

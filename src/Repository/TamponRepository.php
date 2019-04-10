<?php

namespace App\Repository;

use App\Entity\Tampon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tampon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tampon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tampon[]    findAll()
 * @method Tampon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TamponRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tampon::class);
    }

    // /**
    //  * @return Tampon[] Returns an array of Tampon objects
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
    public function findOneBySomeField($value): ?Tampon
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

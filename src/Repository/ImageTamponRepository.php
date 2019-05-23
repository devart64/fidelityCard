<?php

namespace App\Repository;

use App\Entity\ImageTampon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method ImageTampon|null find($id, $lockMode = null, $lockVersion = null)
 * @method ImageTampon|null findOneBy(array $criteria, array $orderBy = null)
 * @method ImageTampon[]    findAll()
 * @method ImageTampon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ImageTamponRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, ImageTampon::class);
    }

    // /**
    //  * @return ImageTampon[] Returns an array of ImageTampon objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ImageTampon
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

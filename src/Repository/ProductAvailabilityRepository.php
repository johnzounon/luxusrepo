<?php

namespace App\Repository;

use App\Entity\ProductAvailability;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProductAvailability>
 *
 * @method ProductAvailability|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProductAvailability|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProductAvailability[]    findAll()
 * @method ProductAvailability[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductAvailabilityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProductAvailability::class);
    }

//    /**
//     * @return ProductAvailability[] Returns an array of ProductAvailability objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ProductAvailability
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

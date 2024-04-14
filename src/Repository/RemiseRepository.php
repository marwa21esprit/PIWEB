<?php

namespace App\Repository;

use App\Entity\Remiseentry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Remiseentry>
 *
 * @method Remiseentry|null find($id, $lockMode = null, $lockVersion = null)
 * @method Remiseentry|null findOneBy(array $criteria, array $orderBy = null)
 * @method Remiseentry[]    findAll()
 * @method Remiseentry[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RemiseRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Remiseentry::class);
    }

//    /**
//     * @return Remiseentry[] Returns an array of Remiseentry objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Remiseentry
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

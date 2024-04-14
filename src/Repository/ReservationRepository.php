<?php

namespace App\Repository;

use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;


/**
 * @extends ServiceEntityRepository<Reservation>
 *
 * @method Reservation|null find($id, $lockMode = null, $lockVersion = null)
 * @method Reservation|null findOneBy(array $criteria, array $orderBy = null)
 * @method Reservation[]    findAll()
 * @method Reservation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Reservation::class);
    }

    public function findBySearchQuery(string $query): array
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.name LIKE :query')
            ->setParameter('query', $query . '%')
            ->getQuery()
            ->getResult();
    }

    public function getTotalReservations(): int
    {
        return $this->createQueryBuilder('r')
            ->select('SUM(r.nbPlaces)') 
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getMostReservedEvent(): ?string
    {
        return $this->createQueryBuilder('r')
            ->select('r.nameE')
            ->groupBy('r.nameE')
            ->orderBy('COUNT(r.nameE)', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function getEventData(): array
{
    return $this->createQueryBuilder('r')
        ->select('r.nameE, SUM(r.nbPlaces) as totalPlaces')
        ->groupBy('r.nameE')
        ->getQuery()
        ->getResult();
}
//    /**
//     * @return Reservation[] Returns an array of Reservation objects
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

//    public function findOneBySomeField($value): ?Reservation
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

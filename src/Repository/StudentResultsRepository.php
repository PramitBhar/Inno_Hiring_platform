<?php

namespace App\Repository;

use App\Entity\StudentResults;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<StudentResults>
 *
 * @method StudentResults|null find($id, $lockMode = null, $lockVersion = null)
 * @method StudentResults|null findOneBy(array $criteria, array $orderBy = null)
 * @method StudentResults[]    findAll()
 * @method StudentResults[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StudentResultsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, StudentResults::class);
    }

    //    /**
    //     * @return StudentResults[] Returns an array of StudentResults objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('s')
    //            ->andWhere('s.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('s.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

       public function getName($value): ?StudentResults
       {
           return $this->createQueryBuilder('s')
               ->andWhere('s.userId = :val')
               ->setParameter('val', $value)
               ->getQuery()
               ->getResult()
           ;
       }
}

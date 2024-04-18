<?php

namespace App\Repository;

use App\Entity\ExamList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ExamList>
 *
 * @method ExamList|null find($id, $lockMode = null, $lockVersion = null)
 * @method ExamList|null findOneBy(array $criteria, array $orderBy = null)
 * @method ExamList[]    findAll()
 * @method ExamList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ExamListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ExamList::class);
    }

    //    /**
    //     * @return ExamList[] Returns an array of ExamList objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

       public function findOneBySomeField($value): ?ExamList
       {
           return $this->createQueryBuilder('e')
               ->andWhere('e.examUniqueId = :val')
               ->setParameter('val', $value)
               ->getQuery()
               ->getOneOrNullResult()
           ;
       }
}

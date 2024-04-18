<?php

namespace App\Repository;

use App\Entity\McqQuestionList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<McqQuestionList>
 *
 * @method McqQuestionList|null find($id, $lockMode = null, $lockVersion = null)
 * @method McqQuestionList|null findOneBy(array $criteria, array $orderBy = null)
 * @method McqQuestionList[]    findAll()
 * @method McqQuestionList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class McqQuestionListRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, McqQuestionList::class);
    }

//    /**
//     * @return McqQuestionList[] Returns an array of McqQuestionList objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('m')
//            ->andWhere('m.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('m.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

   public function findOneBySomeField($value)
   {
       return $this->createQueryBuilder('m')
           ->andWhere('m.exam_unique_id = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getResult()
       ;
   }
   public function getAns($value)
   {
     return $this->createQueryBuilder('m')
           ->andWhere('m.question_unique_id = :val')
           ->setParameter('val', $value)
           ->getQuery()
           ->getResult()
       ;
   }
}

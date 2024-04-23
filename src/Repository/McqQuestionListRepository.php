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

  /**
   * This function is used to find all the question present in an exam
   *
   * @param string $value
   *  It is contain the exam id
   * @return McqQuestionList[] Returns an array of McqQuestionList objects
   */
  public function findOneBySomeField(string $value)
  {
      return $this->createQueryBuilder('m')
          ->andWhere('m.exam_unique_id = :val')
          ->setParameter('val', $value)
          ->getQuery()
          ->getResult()
      ;
  }

  /**
   * This function is used to find the answer of an particular question.
   *
   * @param string $value
   *  It is store the question id.
   * @return void
   */
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

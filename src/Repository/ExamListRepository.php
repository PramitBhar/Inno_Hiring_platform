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

  /**
   * This function is used to fetch exam data based of exam unique id.
   */

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

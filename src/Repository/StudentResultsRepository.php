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
  /**
   * This function to fetch the user profile data based on user unique id.
   *
   * @param string $value
   * @return StudentResults|null
   */
  public function getName(string $value): ?StudentResults
  {
      return $this->createQueryBuilder('s')
          ->andWhere('s.userId = :val')
          ->setParameter('val', $value)
          ->getQuery()
          ->getResult()
      ;
  }
}

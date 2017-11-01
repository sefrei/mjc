<?php

namespace AppBundle\Repository;

/**
 * EventRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EventRepository extends \Doctrine\ORM\EntityRepository
{
  public function showNextEvents()
  {
    $today = new \DateTime();
      $query = $this->createQueryBuilder('e')
      ->setMaxResults(3)
      ->select('e')
      // ->addSelect('l.startAt')
      ->where('e.date >= ?1')
      ->setParameter(1, $today->format('Y-m-d 23:59:59'))
      ->getQuery()->getResult();
      return $query;
  }


  public function showPreviousEvents()
  /*
  {
    $query = $this->getEntityManager()->createQuery(
        "SELECT e FROM AppBundle:Event e
        WHERE date < NOW() ORDERBY e.date DESC"
  );
  return $query;
  }
  */
  {
    $today = new \DateTime();
      $query = $this->createQueryBuilder('e')
      ->select('e')
      // ->addSelect('l.startAt')
      ->where('e.date < ?1')
      ->setParameter(1, $today->format('Y-m-d 23:59:59'))
      ->getQuery()->getResult();
      return $query;
  }
}

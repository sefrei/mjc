<?php

namespace AppBundle\Repository;


/**
 * LessonRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LessonRepository extends \Doctrine\ORM\EntityRepository
{
    public function showAllAction()
    {
$today0 = new \DateTime();
// $today0->format(('Y-m-d 00:00:00 1'));

$today1 = new \DateTime();
$today1->format(('Y-m-d 23:59:59'));
// dump($today1);

      $query = $this->getEntityManager()->createQuery(
          'SELECT s FROM AppBundle:Lesson s WHERE s.startAt> ?1 AND s.startAt< ?2 ORDER BY s.startAt');
          $query->setParameter(1, $today0->format('Y-m-d 00:00:00'));
          $query->setParameter(2, $today1->format('Y-m-d 23:59:59'));

      $result = $query->getResult();

return $result;
    }

    public function findByCurrentUser($userId)
    {
        $today0 = new \DateTime();
        // $today0->format(('Y-m-d 00:00:00 1'));

        $today1 = new \DateTime();
        $today1->format(('Y-m-d 23:59:59'));
        dump($today1);
        exit;
        $query = $this->getEntityManager()->createQuery(
          'SELECT l FROM AppBundle:Lesson l
          JOIN AppBundle:Subscription s
          WHERE s.teacherId = ?3 OR s.student = ?3
          AND l.startAt> ?1 AND l.startAt< ?2 ORDER BY s.startAt');
          $query->setParameter(1, $today0->format('Y-m-d 00:00:00'));
          $query->setParameter(2, $today1->format('Y-m-d 23:59:59'));
          $query->setParameter(3, $userId);
        // $result = $query->getResult();

        return $query;
        }
}

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

    public function getLessonsFromDate($date)
    {

      $query = $this->getEntityManager()->createQuery(
          'SELECT s FROM AppBundle:Lesson s WHERE s.startAt> ?1 AND s.startAt< ?2 ORDER BY s.startAt');
          $query->setParameter(1, $date->format('Y-m-d 00:00:00'));
          $query->setParameter(2, $date->format('Y-m-d 23:59:59'));

      $result = $query->getResult();

      return $result;
    }

    public function getLessonsFromDateAndId($date, $id)
    {
      $query = $this->getEntityManager()->createQuery(
          'SELECT l FROM AppBundle:Lesson l
          JOIN  AppBundle:Subscription s
          WHERE
          l.startAt> ?1
          AND l.startAt< ?2
          AND l.subscription = s.id
          AND (s.teacher = ?3 OR s.student = ?3)
          ');
          $query->setParameter(1, $date->format('Y-m-d 00:00:00'));
          $query->setParameter(2, $date->format('Y-m-d 23:59:59'));
          $query->setParameter(3, $id);

          $result = $query->getResult();
          return $result;
    }

    public function findByCurrentUser()
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
          WHERE s.teacher = ?3 OR s.student = ?3
          AND l.startAt> ?1 AND l.startAt< ?2 ORDER BY s.startAt');
          $query->setParameter(1, $today0->format('Y-m-d 00:00:00'));
          $query->setParameter(2, $today1->format('Y-m-d 23:59:59'));
          $query->setParameter(3, $userId);
        $result = $query->getResult();

        return $result;
        }

        public function lessonsNowAfter($id)
        {
            $today = new \DateTime();
            $finishDate = new \DateTime();

          $query = $this->createQueryBuilder('l')
            // ->select('l')
            ->select('count(l) as nb, SUBSTRING(l.startAt, 9, 2) as day')
            ->join('AppBundle:Subscription' ,'s')
            ->where('s.teacher = ?1 OR s.student = ?1')
            ->andwhere('l.startAt > ?2')
            ->andwhere('l.startAt < ?3')

            ->groupBy('day')
            ->setParameter(1, $id)
            ->setParameter(2, $today)
            ->setParameter(3, $finishDate->format('2017-06-14 23:59:59'))
            ->getQuery()->getResult();
//
//

            return $query;
          //   count(DISTINCT(lesson.id))
          //   FROM AppBundle:Lesson l
          //   JOIN AppBundle:Subscription s
          //   WHERE (s.teacher = ?1 OR s.student = ?1)
          //   AND DATE('l.startAt') > ?2 group by convert(varchar, l.startAt, 101)');
          // $query->setParameter(1, $id);
          // $query->setParameter(2, $today);



        }
         // SELECT DATE(lesson.startAt), count(DISTINCT(lesson.id)) FROM `lesson` inner join subscription where lesson.startAt > DATE(Now()) and (subscription.teacher_id = 5 or subscription.student_id = 5) group by DATE(lesson.startAt) ORDER BY DATE(lesson.startAt) ASC
}

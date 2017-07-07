<?php

namespace AppBundle\Repository;

/**
 * NotificationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class NotificationRepository extends \Doctrine\ORM\EntityRepository
{


  public function findNotificationByEntityTypeIdAndSpecification($entityType, $entityTypeId, $specification, $userId){
      $query = $this->createQueryBuilder('n')
      ->select('n')
      ->where('n.idEntityType = ?1')
      ->andWhere('n.specification = ?2')
      ->andWhere('n.entityType = ?3')
      ->andWhere('n.notifier = ?4')
      ->setParameter(1, $entityTypeId)
      ->setParameter(2, $specification)
      ->setParameter(3, $entityType)
      ->setParameter(4, $userId)
      ->getQuery()->getResult();
      return $query;
  }

  public function findNotificationAndLinkedEntity($entityType, $entityTypeId, $specification, $userId){

      $query = $this->createQueryBuilder('n')
      ->select('n')
      ->join('AppBundle:' .$entityType ,'e')
      ->addwhere('n.idEntityType = e.id')
      ->where('n.idEntityType = ?1')
      ->andWhere('n.specification = ?2')
      ->andWhere('n.entityType = ?3')
      ->andWhere('n.user = ?4')
      ->setParameter(1, $entityTypeId)
      ->setParameter(2, $specification)
      ->setParameter(3, $entityType)
      ->setParameter(4, $userId)
      ->getQuery()->getResult();
      return $query;
  }


  public function findAllNotificationsForOneUser($userId)
  {
      $query = $this->createQueryBuilder('n')
      ->select('n.id, n.idEntityType, n.message, n.createdAt, n.entityType')
      ->join('AppBundle:Reading_notification' ,'r')
      ->addSelect('r.isRead, r.id')
      ->where('r.notifiedUser = ?1')
      ->andWhere('n.id = r.notification')
      ->setParameter(1, $userId)
      ->getQuery()->getResult();
      return $query;
  }



  //Ce qu'il me faut
  // l'id de la notif ->(n)
// l'id de l'activité (n)
// le message (n)
// Letat de la notif : Lu / pas lu
//la date (n)
}

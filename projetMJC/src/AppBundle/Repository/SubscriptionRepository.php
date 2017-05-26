<?php

namespace AppBundle\Repository;

/**
 * SubscriptionRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SubscriptionRepository extends \Doctrine\ORM\EntityRepository
{
  public function showAllAction()
  {
    $query = $this->getEntityManager()->createQuery(
        'SELECT s FROM AppBundle:Subscription s ORDER BY s.subscriptionAt DESC'
    );

    

    return $query->getResult();

  }
}

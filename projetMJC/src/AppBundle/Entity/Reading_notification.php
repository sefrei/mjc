<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reading_notification
 *
 * @ORM\Table(name="reading_notification")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\Reading_notificationRepository")
 */
class Reading_notification
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * Many Reading for One Notification
     * @ORM\ManyToOne(targetEntity="Notification")
     * @ORM\JoinColumn(name="notification_id", referencedColumnName="id", unique=false)
     */
    private $idNotification;

    /**
     * Many Reads for One User
     * @ORM\ManyToOne(targetEntity="User",inversedBy="readings" )
     * @ORM\JoinColumn(name="notified_user_id", referencedColumnName="id", unique=false)
     */
    private $idNotifiedUser;


    /**
    * Many Reading_notifications for One Notification
    * @ORM\ManyToOne(targetEntity="Notification", inversedBy="reading_notifications")
    */
    private $notification;

    /**
     * @var bool
     *
     * @ORM\Column(name="is_read", type="boolean")
     */
    private $isRead;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }



    /**
     * Set isRead
     *
     * @param boolean $isRead
     *
     * @return Reading_notification
     */
    public function setIsRead($isRead)
    {
        $this->isRead = $isRead;

        return $this;
    }

    /**
     * Get isRead
     *
     * @return bool
     */
    public function getIsRead()
    {
        return $this->isRead;
    }

    /**
     * Set idNotification
     *
     * @param \AppBundle\Entity\Notifiction $idNotification
     *
     * @return Reading_notification
     */
    public function setIdNotification(\AppBundle\Entity\Notifiction $idNotification = null)
    {
        $this->idNotification = $idNotification;

        return $this;
    }

    /**
     * Get idNotification
     *
     * @return \AppBundle\Entity\Notifiction
     */
    public function getIdNotification()
    {
        return $this->idNotification;
    }

    /**
     * Set idNotifiedUser
     *
     * @param \AppBundle\Entity\User $idNotifiedUser
     *
     * @return Reading_notification
     */
    public function setIdNotifiedUser(\AppBundle\Entity\User $idNotifiedUser = null)
    {
        $this->idNotifiedUser = $idNotifiedUser;

        return $this;
    }

    /**
     * Get idNotifiedUser
     *
     * @return \AppBundle\Entity\User
     */
    public function getIdNotifiedUser()
    {
        return $this->idNotifiedUser;
    }

    /**
     * Set notification
     *
     * @param \AppBundle\Entity\Notification $notification
     *
     * @return Reading_notification
     */
    public function setNotification(\AppBundle\Entity\Notification $notification = null)
    {
        $this->notification = $notification;

        return $this;
    }

    /**
     * Get notification
     *
     * @return \AppBundle\Entity\Notification
     */
    public function getNotification()
    {
        return $this->notification;
    }
}

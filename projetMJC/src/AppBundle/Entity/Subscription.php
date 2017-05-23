<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use AppBundle\Entity\User;

/**
 * Subscription
 *
 * @ORM\Table(name="subsrciption")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SubscriptionRepository")
 */
class Subscription
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
     * @var \DateTime
     *
     * @ORM\Column(name="startAt", type="datetime")
     */
    private $startAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="finishAt", type="datetime")
     */
    private $finishAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="subscriptionAt", type="datetime")
     */
    private $subscriptionAt;

    /**
     * One Subscription has One Teacher(in User with ROLE_TEACHER)
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="teacher_id", referencedColumnName="id")
     */
    private $teacher;

    /**
     * One Subscription has One Student(in User with ROLE_STUDENT)
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    private $student;
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
     * Set startAt
     *
     * @param \DateTime $startAt
     *
     * @return Subscription
     */
    public function setStartAt($startAt)
    {
        $this->startAt = $startAt;

        return $this;
    }

    /**
     * Get startAt
     *
     * @return \DateTime
     */
    public function getStartAt()
    {
        return $this->startAt;
    }

    /**
     * Set finishAt
     *
     * @param \DateTime $finishAt
     *
     * @return Subscription
     */
    public function setFinishAt($finishAt)
    {
        $this->finishAt = $finishAt;

        return $this;
    }

    /**
     * Get finishAt
     *
     * @return \DateTime
     */
    public function getFinishAt()
    {
        return $this->finishAt;
    }

    /**
     * Set subscriptionAt
     *
     * @param \DateTime $subscriptionAt
     *
     * @return Subscription
     */
    public function setSubscriptionAt($subscriptionAt)
    {
        $this->subscriptionAt = $subscriptionAt;

        return $this;
    }

    /**
     * Get subscriptionAt
     *
     * @return \DateTime
     */
    public function getSubscriptionAt()
    {
        return $this->subscriptionAt;
    }

    /**
     * Set teacher
     *
     * @param \AppBundle\Entity\Subscription $teacher
     *
     * @return Subscription
     */
    public function setTeacher(\AppBundle\Entity\Subscription $teacher = null)
    {
        $this->teacher = $teacher;

        return $this;
    }

    /**
     * Get teacher
     *
     * @return \AppBundle\Entity\Subscription
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * Set student
     *
     * @param \AppBundle\Entity\Subscription $student
     *
     * @return Subscription
     */
    public function setStudent(\AppBundle\Entity\Subscription $student = null)
    {
        $this->student = $student;

        return $this;
    }

    /**
     * Get student
     *
     * @return \AppBundle\Entity\Subscription
     */
    public function getStudent()
    {
        return $this->student;
    }
}

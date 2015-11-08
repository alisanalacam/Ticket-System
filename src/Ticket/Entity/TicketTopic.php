<?php

namespace Ticket\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TicketTopic
 */
class TicketTopic
{
    /**
     * @var integer
     */
    private $id;

    /**
     * @var integer
     */
    private $authorId;

    /**
     * @var integer
     */
    private $recepientId;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var integer
     */
    private $priorityId;

    /**
     * @var integer
     */
    private $statusId;

    /**
     * @var string
     */
    private $content;

    /**
     * @var string
     */
    private $userIp;

    /**
     * @var boolean
     */
    private $deleted;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $updatedAt;

    /**
     * @var \DateTime
     */
    private $deletedAt;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set authorId
     *
     * @param integer $authorId
     * @return TicketTopic
     */
    public function setAuthorId($authorId)
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get authorId
     *
     * @return integer
     */
    public function getAuthorId()
    {
        return $this->authorId;
    }

    /**
     * Set recepientId
     *
     * @param integer $recepientId
     * @return TicketTopic
     */
    public function setRecepientId($recepientId)
    {
        $this->recepientId = $recepientId;

        return $this;
    }

    /**
     * Get recepientId
     *
     * @return integer
     */
    public function getRecepientId()
    {
        return $this->recepientId;
    }

    /**
     * Set subject
     *
     * @param string $subject
     * @return TicketTopic
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set priorityId
     *
     * @param integer $priorityId
     * @return TicketTopic
     */
    public function setPriorityId($priorityId)
    {
        $this->priorityId = $priorityId;

        return $this;
    }

    /**
     * Get priorityId
     *
     * @return integer
     */
    public function getPriorityId()
    {
        return $this->priorityId;
    }

    /**
     * Set statusId
     *
     * @param integer $statusId
     * @return TicketTopic
     */
    public function setStatusId($statusId)
    {
        $this->statusId = $statusId;

        return $this;
    }

    /**
     * Get statusId
     *
     * @return integer
     */
    public function getStatusId()
    {
        return $this->statusId;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return TicketTopic
     */
    public function setContent($content)
    {
        $this->content = $content;

        return $this;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent()
    {
        return $this->content;
    }

    /**
     * Set userIp
     *
     * @param string $userIp
     * @return TicketTopic
     */
    public function setUserIp($userIp)
    {
        $this->userIp = $userIp;

        return $this;
    }

    /**
     * Get userIp
     *
     * @return string
     */
    public function getUserIp()
    {
        return $this->userIp;
    }

    /**
     * Set deleted
     *
     * @param boolean $deleted
     * @return TicketTopic
     */
    public function setDeleted($deleted)
    {
        $this->deleted = $deleted;

        return $this;
    }

    /**
     * Get deleted
     *
     * @return boolean
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     * @return TicketTopic
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return TicketTopic
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * Set deletedAt
     *
     * @param \DateTime $deletedAt
     * @return TicketTopic
     */
    public function setDeletedAt($deletedAt)
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }

    /**
     * Get deletedAt
     *
     * @return \DateTime
     */
    public function getDeletedAt()
    {
        return $this->deletedAt;
    }
}

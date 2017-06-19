<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GratDate
 *
 * @ORM\Table(name="grat_date")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GratDateRepository")
 */
class GratDate
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
     * @var int
     *
     * @ORM\Column(name="user_id", type="integer")
     */
    private $userId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha_dt", type="datetimetz")
     */
    private $fechaDt;

    /**
     * @var int
     *
     * @ORM\Column(name="status", type="integer")
     */
    private $status;


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
     * Set userId
     *
     * @param integer $userId
     *
     * @return GratDate
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set fechaDt
     *
     * @param \DateTime $fechaDt
     *
     * @return GratDate
     */
    public function setFechaDt($fechaDt)
    {
        $this->fechaDt = $fechaDt;

        return $this;
    }

    /**
     * Get fechaDt
     *
     * @return \DateTime
     */
    public function getFechaDt()
    {
        return $this->fechaDt;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return GratDate
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }
}


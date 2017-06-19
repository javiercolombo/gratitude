<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UserLogin
 *
 * @ORM\Table(name="user_login")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserLoginRepository")
 */
class UserLogin
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
     * @ORM\Column(name="login_dt", type="datetimetz")
     */
    private $loginDt;


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
     * @return UserLogin
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
     * Set loginDt
     *
     * @param \DateTime $loginDt
     *
     * @return UserLogin
     */
    public function setLoginDt($loginDt)
    {
        $this->loginDt = $loginDt;

        return $this;
    }

    /**
     * Get loginDt
     *
     * @return \DateTime
     */
    public function getLoginDt()
    {
        return $this->loginDt;
    }
}


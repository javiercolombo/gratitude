<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GratItem
 *
 * @ORM\Table(name="grat_item")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\GratItemRepository")
 */
class GratItem
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
     * @ORM\Column(name="grat_id", type="integer")
     */
    private $gratId;

    /**
     * @var string
     *
     * @ORM\Column(name="grat_text", type="string", length=255)
     */
    private $gratText;

    /**
     * @var bool
     *
     * @ORM\Column(name="favorite_flag", type="boolean")
     */
    private $favoriteFlag;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="insert_dt", type="datetimetz")
     */
    private $insertDt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="update_dt", type="datetimetz", nullable=true)
     */
    private $updateDt;


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
     * Set gratId
     *
     * @param integer $gratId
     *
     * @return GratItem
     */
    public function setGratId($gratId)
    {
        $this->gratId = $gratId;

        return $this;
    }

    /**
     * Get gratId
     *
     * @return int
     */
    public function getGratId()
    {
        return $this->gratId;
    }

    /**
     * Set gratText
     *
     * @param string $gratText
     *
     * @return GratItem
     */
    public function setGratText($gratText)
    {
        $this->gratText = $gratText;

        return $this;
    }

    /**
     * Get gratText
     *
     * @return string
     */
    public function getGratText()
    {
        return $this->gratText;
    }

    /**
     * Set favoriteFlag
     *
     * @param boolean $favoriteFlag
     *
     * @return GratItem
     */
    public function setFavoriteFlag($favoriteFlag)
    {
        $this->favoriteFlag = $favoriteFlag;

        return $this;
    }

    /**
     * Get favoriteFlag
     *
     * @return bool
     */
    public function getFavoriteFlag()
    {
        return $this->favoriteFlag;
    }

    /**
     * Set insertDt
     *
     * @param \DateTime $insertDt
     *
     * @return GratItem
     */
    public function setInsertDt($insertDt)
    {
        $this->insertDt = $insertDt;

        return $this;
    }

    /**
     * Get insertDt
     *
     * @return \DateTime
     */
    public function getInsertDt()
    {
        return $this->insertDt;
    }

    /**
     * Set updateDt
     *
     * @param \DateTime $updateDt
     *
     * @return GratItem
     */
    public function setUpdateDt($updateDt)
    {
        $this->updateDt = $updateDt;

        return $this;
    }

    /**
     * Get updateDt
     *
     * @return \DateTime
     */
    public function getUpdateDt()
    {
        return $this->updateDt;
    }
}


<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Quote
 *
 * @ORM\Table(name="quote")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\QuoteRepository")
 */
class Quote
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
     * @var string
     *
     * @ORM\Column(name="quote_string", type="text")
     */
    private $quoteString;


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
     * Set quoteString
     *
     * @param string $quoteString
     *
     * @return Quote
     */
    public function setQuoteString($quoteString)
    {
        $this->quoteString = $quoteString;

        return $this;
    }

    /**
     * Get quoteString
     *
     * @return string
     */
    public function getQuoteString()
    {
        return $this->quoteString;
    }
}


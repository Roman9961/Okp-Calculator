<?php

namespace CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Currency
 *
 * @ORM\Table(name="currency")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\CurrencyRepository")
 */
class Currency
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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="exchangeRate", type="float")
     */
    private $exchangeRate;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Paper", mappedBy="currency")
     */
    private $papers;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\PrintType", mappedBy="currency")
     */
    private $printTypes;

    /**
     * Currency constructor.
     * @param string $papers
     * @param string $printTypes
     */
    public function __construct($papers, $printTypes)
    {
        $this->papers = new ArrayCollection();
        $this->printTypes = new ArrayCollection();
    }

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
     * Set name
     *
     * @param string $name
     *
     * @return Currency
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set exchangeRate
     *
     * @param float $exchangeRate
     *
     * @return Currency
     */
    public function setExchangeRate($exchangeRate)
    {
        $this->exchangeRate = $exchangeRate;

        return $this;
    }

    /**
     * Get exchangeRate
     *
     * @return float
     */
    public function getExchangeRate()
    {
        return $this->exchangeRate;
    }
}


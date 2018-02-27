<?php

namespace CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PrintType
 *
 * @ORM\Table(name="print_type")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PrintTypeRepository")
 */
class PrintType
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
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Currency", inversedBy="printTypes")
     * @ORM\JoinColumn(nullable=true)
     */
    private $currency;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Printing", mappedBy="sideA")
     */
    private $printSideA;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Printing", mappedBy="sideB")
     */
    private $printSideB;

    /**
     * PrintType constructor.
     * @param string $printSideA
     * @param string $printSideB
     */
    public function __construct($printSideA, $printSideB)
    {
        $this->printSideA = new ArrayCollection();
        $this->printSideB = new ArrayCollection();
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
     * @return PrintType
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
     * Set price
     *
     * @param float $price
     *
     * @return PrintType
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price*$this->currency->getExchangeRate();
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @param mixed $currency
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }


}


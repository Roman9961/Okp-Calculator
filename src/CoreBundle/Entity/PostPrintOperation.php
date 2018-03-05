<?php

namespace CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Printing
 *
 * @ORM\Table(name="post_print_operation")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PostPrintOperationRepository")
 */
class PostPrintOperation
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
     * @ORM\Column(type="integer", options={"comment" = "количество повторений на единицу продукции, напр. 2 скобы в буклете","default":1})
     */
    private $multiplier;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\PostPrintMaterial", inversedBy="postPrintOperation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $material;

    /**
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Product", mappedBy="postPrint")
     */
    private $products;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Currency", inversedBy="postPrintOperation")
     * @ORM\JoinColumn(nullable=true)
     */
    private $currency;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * Printing constructor.
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
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
     * @return PostPrintOperation
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
     * @return mixed
     */
    public function getMultiplier()
    {
        return $this->multiplier;
    }

    /**
     * @param mixed $multiplier
     * @return PostPrintOperation
     */
    public function setMultiplier($multiplier)
    {
        $this->multiplier = $multiplier;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getMaterial()
    {
        return $this->material;
    }

    /**
     * @param mixed $material
     * @return PostPrintOperation
     */
    public function setMaterial($material)
    {
        $this->material = $material;

        return $this;
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
     * @return PostPrintOperation
     */
    public function setCurrency($currency)
    {
        $this->currency = $currency;

        return $this;
    }


    /**
     * Set price
     *
     * @param float $price
     *
     * @return PostPrintOperation
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

}


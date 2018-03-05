<?php

namespace CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Paper
 *
 * @ORM\Table(name="post_print_material")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PostPrintMaterialRepository")
 */
class PostPrintMaterial
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
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\PostPrintOperation", mappedBy="material")
     */
    private $postPrintOperation;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\Currency", inversedBy="postPrintMaterial")
     * @ORM\JoinColumn(nullable=true)
     */
    private $currency;

    /**
     * Paper constructor.
     */
    public function __construct()
    {
        $this->products = new ArrayCollection();
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
     * Set price
     *
     * @param float $price
     *
     * @return PostPrintMaterial
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
     * Set name
     *
     * @param string $name
     *
     * @return PostPrintMaterial
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

}


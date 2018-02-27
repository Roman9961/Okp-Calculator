<?php

namespace CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\ProductRepository")
 */
class Product
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
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Paper")
     */
    private $papers;

    /**
     * @ORM\ManyToMany(targetEntity="CoreBundle\Entity\Printing")
     */
    private $printings;

    /**
     * @var string
     *
     * @ORM\Column(name="postPrint", type="string", length=255, nullable=true)
     */
    private $postPrint;

    private $count;

    /**
     * Product constructor.
     * @param string $papers
     * @param string $printings
     * @param string $postPrint
     */
    public function __construct($papers, $printings, $postPrint)
    {
        $this->papers = new ArrayCollection();
        $this->printings = new ArrayCollection();
        $this->postPrint = new ArrayCollection();
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
     * @return Product
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
     * Set papers
     *
     * @param Paper[] $papers
     *
     * @return Product
     */
    public function setPapers($papers)
    {
        $this->papers = $papers;

        return $this;
    }

    /**
     * @var Paper[]
     */
    public function getPapers()
    {
        return $this->papers;
    }

    /**
     * Set printings
     *
     * @param Printing[] $printings
     *
     * @return Product
     */
    public function setPrintings($printings)
    {
        $this->printings = $printings;

        return $this;
    }

    /**
     * @var Printing[]
     */
    public function getPrintings()
    {
        return $this->printings;
    }

    /**
     * Set postPrint
     *
     * @param string $postPrint
     *
     * @return Product
     */
    public function setPostPrint($postPrint)
    {
        $this->postPrint = $postPrint;

        return $this;
    }

    /**
     * Get postPrint
     *
     * @return string
     */
    public function getPostPrint()
    {
        return $this->postPrint;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }


}


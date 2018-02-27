<?php

namespace CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Printing
 *
 * @ORM\Table(name="print")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PrintingRepository")
 */
class Printing
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
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\PrintType", inversedBy="printSideA")
     * @ORM\JoinColumn(nullable=false)
     */
    private $sideA;

    /**
     * @ORM\ManyToOne(targetEntity="CoreBundle\Entity\PrintType", inversedBy="printSideB")
     * @ORM\JoinColumn(nullable=true)
     */
    private $sideB;


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
     * @return Print
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
     * Set sideA
     *
     * @param string $sideA
     *
     * @return Print
     */
    public function setSideA($sideA)
    {
        $this->sideA = $sideA;

        return $this;
    }

    /**
     * Get sideA
     *
     * @return string
     */
    public function getSideA()
    {
        return $this->sideA;
    }

    /**
     * Set sideB
     *
     * @param string $sideB
     *
     * @return Print
     */
    public function setSideB($sideB)
    {
        $this->sideB = $sideB;

        return $this;
    }

    /**
     * Get sideB
     *
     * @return string
     */
    public function getSideB()
    {
        return $this->sideB;
    }
}


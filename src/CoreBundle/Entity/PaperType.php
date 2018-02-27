<?php

namespace CoreBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * PaperType
 *
 * @ORM\Table(name="paper_type")
 * @ORM\Entity(repositoryClass="CoreBundle\Repository\PaperTypeRepository")
 */
class PaperType
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\OneToMany(targetEntity="CoreBundle\Entity\Paper", mappedBy="type")
     */
    private $papers;

    /**
     * PaperType constructor.
     * @param string $papers
     */
    public function __construct($papers)
    {
        $this->papers = new ArrayCollection();
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
     * @return PaperType
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
     *
     * @return ArrayCollection|Paper[]
     */
    public function getPapers()
    {
        return $this->papers;
    }
}


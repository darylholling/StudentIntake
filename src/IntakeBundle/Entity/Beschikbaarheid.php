<?php

namespace IntakeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Beschikbaarheid
 *
 * @ORM\Table(name="beschikbaarheid")
 * @ORM\Entity(repositoryClass="IntakeBundle\Repository\BeschikbaarheidRepository")
 */
class Beschikbaarheid
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
     * @ORM\ManyToOne(targetEntity="IntakeBundle\Entity\User")
     * @ORM\JoinColumn(name="docentId", referencedColumnName="id")
     */
    private $docentId;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="begin", type="datetime")
     * @Assert\NotNull()
     */
    private $begin;

    public function __construct()
    {
        $this->begin = new \DateTime('now');
    }

    /**
     * @var int
     *
     * @ORM\Column(name="duur", type="integer")
     */
    private $duur;


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
     * Set docentId
     *
     * @param integer $docentId
     *
     * @return Beschikbaarheid
     */
    public function setDocentId($docentId)
    {
        $this->docentId = $docentId;

        return $this;
    }

    /**
     * Get docentId
     *
     * @return int
     */
    public function getDocentId()
    {
        return $this->docentId;
    }

    /**
     * Set begin
     *
     * @param \DateTime $begin
     *
     * @return Beschikbaarheid
     */
    public function setBegin($begin)
    {
        $this->begin = $begin;

        return $this;
    }

    /**
     * Get begin
     *
     * @return \DateTime
     */
    public function getBegin()
    {
        return $this->begin;
    }

    /**
     * Set duur
     *
     * @param integer $duur
     *
     * @return Beschikbaarheid
     */
    public function setDuur($duur)
    {
        $this->duur = $duur;

        return $this;
    }

    /**
     * Get duur
     *
     * @return int
     */
    public function getDuur()
    {
        return $this->duur;
    }

    public function __toString()
    {
        return $this->getBegin()->format(' H:i:s - d-m-Y');
    }
}


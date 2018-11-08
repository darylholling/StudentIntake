<?php

namespace IntakeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Opleiding
 *
 * @ORM\Table(name="opleiding")
 * @ORM\Entity(repositoryClass="IntakeBundle\Repository\OpleidingRepository")
 */
class Opleiding
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
     * @ORM\ManyToOne(targetEntity="IntakeBundle\Entity\Afdeling")
     * @ORM\JoinColumn(name="afdelingId", referencedColumnName="id", nullable=false)
     */
    private $afdelingId;

    /**
     * @var string
     *
     * @ORM\Column(name="naam", type="string", length=255)
     * @Assert\NotNull()
     */
    private $naam;


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
     * Set afdelingId
     *
     * @param integer $afdelingId
     *
     * @return Opleiding
     */
    public function setAfdelingId($afdelingId)
    {
        $this->afdelingId = $afdelingId;

        return $this;
    }

    /**
     * Get afdelingId
     *
     * @return int
     */
    public function getAfdelingId()
    {
        return $this->afdelingId;
    }

    /**
     * Set naam
     *
     * @param string $naam
     *
     * @return Opleiding
     */
    public function setNaam($naam)
    {
        $this->naam = $naam;

        return $this;
    }

    /**
     * Get naam
     *
     * @return string
     */
    public function getNaam()
    {
        return $this->naam;
    }
    public function __toString()
    {
        return $this->getNaam();
    }
}


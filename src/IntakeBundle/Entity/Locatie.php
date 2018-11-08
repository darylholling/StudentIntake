<?php

namespace IntakeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Locatie
 *
 * @ORM\Table(name="locatie")
 * @ORM\Entity(repositoryClass="IntakeBundle\Repository\LocatieRepository")
 */
class Locatie
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
     * @ORM\Column(name="plaatsnaam", type="string", length=255)
     * @Assert\NotNull()
     */
    private $plaatsnaam;

    /**
     * @var string
     *
     * @ORM\Column(name="adres", type="string", length=255)
     * @Assert\NotNull()
     */
    private $adres;

    /**
     * @var int
     *
     * @ORM\Column(name="huisnummer", type="integer")
     */
    private $huisnummer;

    /**
     * @return int
     */
    public function getHuisnummer()
    {
        return $this->huisnummer;
    }

    /**
     * @param int $huisnummer
     */
    public function setHuisnummer($huisnummer)
    {
        $this->huisnummer = $huisnummer;
    }

    /**
     * @var string
     *
     * @ORM\Column(name="postcode", type="string", length=255)
     */
    private $postcode;


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
     * Set plaatsnaam
     *
     * @param string $plaatsnaam
     *
     * @return Locatie
     */
    public function setPlaatsnaam($plaatsnaam)
    {
        $this->plaatsnaam = $plaatsnaam;

        return $this;
    }

    /**
     * Get plaatsnaam
     *
     * @return string
     */
    public function getPlaatsnaam()
    {
        return $this->plaatsnaam;
    }

    /**
     * Set adres
     *
     * @param string $adres
     *
     * @return Locatie
     */
    public function setAdres($adres)
    {
        $this->adres = $adres;

        return $this;
    }

    /**
     * Get adres
     *
     * @return string
     */
    public function getAdres()
    {
        return $this->adres;
    }

    /**
     * Set postcode
     *
     * @param string $postcode
     *
     * @return Locatie
     */
    public function setPostcode($postcode)
    {
        $this->postcode = $postcode;

        return $this;
    }

    /**
     * Get postcode
     *
     * @return string
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    public function __toString()
    {
        return $this->getPlaatsnaam();
    }
}


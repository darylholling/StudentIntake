<?php

namespace IntakeBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Afspraak
 *
 * @ORM\Table(name="afspraak")
 * @ORM\Entity(repositoryClass="IntakeBundle\Repository\AfspraakRepository")
 */
class Afspraak
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
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     */
    private $userId;

    /**
     * @ORM\ManyToOne(targetEntity="IntakeBundle\Entity\Locatie")
     * @ORM\JoinColumn(name="locatie_id", referencedColumnName="id", nullable=false)
     */
    private $locatieId;

    /**
     * @ORM\ManyToOne(targetEntity="IntakeBundle\Entity\Afdeling")
     * @ORM\JoinColumn(name="afdeling_id", referencedColumnName="id")
     */
    private $afdelingId;

    /**
     * @ORM\ManyToOne(targetEntity="IntakeBundle\Entity\Opleiding")
     * @ORM\JoinColumn(name="afdelingId", referencedColumnName="id", nullable=false)
     */
    private $opleidingId;


    /**
     * @ORM\ManyToOne(targetEntity="IntakeBundle\Entity\Beschikbaarheid")
     * @ORM\JoinColumn(name="beschikbaarheid_id", referencedColumnName="id", nullable=false)
     */
    private $beschikbaarheidId;

    protected $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getOpleidingId()
    {
        return $this->opleidingId;
    }

    /**
     * @param mixed $opleidingId
     */
    public function setOpleidingId($opleidingId)
    {
        $this->opleidingId = $opleidingId;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    public function __construct()
    {
        $this->user = new ArrayCollection();
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
     * Set userId
     *
     * @param integer $userId
     *
     * @return Afspraak
     */
    public function setUserId($userId)
    {
        $this->userId = $userId;

        return $this;
    }

    /**
     * Get userId
     *
     * @return int
     */
    public function getUserId()
    {
        return $this->userId;
    }

    /**
     * Set locatieId
     *
     * @param integer $locatieId
     *
     * @return Afspraak
     */
    public function setLocatieId($locatieId)
    {
        $this->locatieId = $locatieId;

        return $this;
    }

    /**
     * Get locatieId
     *
     * @return int
     */
    public function getLocatieId()
    {
        return $this->locatieId;
    }

    /**
     * Set afdelingId
     *
     * @param integer $afdelingId
     *
     * @return Afspraak
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
     * Set beschikbaarheidId
     *
     * @param integer $beschikbaarheidId
     *
     * @return Afspraak
     */
    public function setBeschikbaarheidId($beschikbaarheidId)
    {
        $this->beschikbaarheidId = $beschikbaarheidId;

        return $this;
    }

    /**
     * Get beschikbaarheidId
     *
     * @return int
     */
    public function getBeschikbaarheidId()
    {
        return $this->beschikbaarheidId;
    }
}


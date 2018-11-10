<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Internaute
 *
 * @ORM\Table(name="internaute")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\InternauteRepository")
 */
class Internaute
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="cni", type="string", length=255, nullable=true)
     */
    private $cni;

    /**
     * @var string
     *
     * @ORM\Column(name="passeport", type="string", length=255, nullable=true)
     */
    private $passeport;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_nai", type="date")
     */
    private $dateNai;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_nai", type="string", length=255)
     */
    private $lieuNai;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_enreg", type="datetime")
     */
    private $dateEnreg;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Internaute
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Internaute
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return Internaute
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set cni
     *
     * @param string $cni
     *
     * @return Internaute
     */
    public function setCni($cni)
    {
        $this->cni = $cni;

        return $this;
    }

    /**
     * Get cni
     *
     * @return string
     */
    public function getCni()
    {
        return $this->cni;
    }

    /**
     * Set passeport
     *
     * @param string $passeport
     *
     * @return Internaute
     */
    public function setPasseport($passeport)
    {
        $this->passeport = $passeport;

        return $this;
    }

    /**
     * Get passeport
     *
     * @return string
     */
    public function getPasseport()
    {
        return $this->passeport;
    }

    /**
     * Set dateNai
     *
     * @param \DateTime $dateNai
     *
     * @return Internaute
     */
    public function setDateNai($dateNai)
    {
        $this->dateNai = $dateNai;

        return $this;
    }

    /**
     * Get dateNai
     *
     * @return \DateTime
     */
    public function getDateNai()
    {
        return $this->dateNai;
    }

    /**
     * Set lieuNai
     *
     * @param string $lieuNai
     *
     * @return Internaute
     */
    public function setLieuNai($lieuNai)
    {
        $this->lieuNai = $lieuNai;

        return $this;
    }

    /**
     * Get lieuNai
     *
     * @return string
     */
    public function getLieuNai()
    {
        return $this->lieuNai;
    }

    /**
     * Set dateEnreg
     *
     * @param \DateTime $dateEnreg
     *
     * @return Internaute
     */
    public function setDateEnreg($dateEnreg)
    {
        $this->dateEnreg = $dateEnreg;

        return $this;
    }

    /**
     * Get dateEnreg
     *
     * @return \DateTime
     */
    public function getDateEnreg()
    {
        return $this->dateEnreg;
    }
}

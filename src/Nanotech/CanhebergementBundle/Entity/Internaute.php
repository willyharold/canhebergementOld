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
     * @ORM\Column(name="email", type="string", length=255,unique=true)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="telephone", type="string", length=255)
     */
    private $telephone;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255)
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="nationalite", type="string", length=255)
     */
    private $nationalite;

    /**
     * @var string
     *
     * @ORM\Column(name="cni", type="string", length=255, nullable=true)
     */
    private $typedocument;

    /**
     * @var string
     *
     * @ORM\Column(name="passeport", type="string", length=255, nullable=true)
     */
    private $numdocument;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_nai", type="date",nullable=true)
     */
    private $dateNai;

    /**
     * @var string
     *
     * @ORM\Column(name="lieu_nai", type="string", length=255,nullable=true)
     */
    private $lieuNai;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_enreg", type="datetime")
     */
    private $dateEnreg;

    public function __construct()
    {
        $this->dateEnreg = new \DateTime();

    }


    /**
     * Get id
     *
     * @return integer
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
     * Set telephone
     *
     * @param string $telephone
     *
     * @return Internaute
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return string
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Internaute
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set nationalite
     *
     * @param string $nationalite
     *
     * @return Internaute
     */
    public function setNationalite($nationalite)
    {
        $this->nationalite = $nationalite;

        return $this;
    }

    /**
     * Get nationalite
     *
     * @return string
     */
    public function getNationalite()
    {
        return $this->nationalite;
    }

    /**
     * Set typedocument
     *
     * @param string $typedocument
     *
     * @return Internaute
     */
    public function setTypedocument($typedocument)
    {
        $this->typedocument = $typedocument;

        return $this;
    }

    /**
     * Get typedocument
     *
     * @return string
     */
    public function getTypedocument()
    {
        return $this->typedocument;
    }

    /**
     * Set numdocument
     *
     * @param string $numdocument
     *
     * @return Internaute
     */
    public function setNumdocument($numdocument)
    {
        $this->numdocument = $numdocument;

        return $this;
    }

    /**
     * Get numdocument
     *
     * @return string
     */
    public function getNumdocument()
    {
        return $this->numdocument;
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
     * Set pays
     *
     * @param string $pays
     *
     * @return Internaute
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
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

    public function __toString() {
        return $this->nom? $this->nom." ":" ";

    }
}

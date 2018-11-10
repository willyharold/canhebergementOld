<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MoyenPaiement
 *
 * @ORM\Table(name="moyen_paiement")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\MoyenPaiementRepository")
 */
class MoyenPaiement
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_enreg", type="datetime")
     */
    private $dateEnreg;

    /**
     * @var string
     *
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

    /**
     * @var string
     *
     * @ORM\Column(name="secretid", type="string", length=255)
     */
    private $secretid;

    /**
     * @var string
     *
     * @ORM\Column(name="clientid", type="string", length=255)
     */
    private $clientid;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var bool
     *
     * @ORM\Column(name="national", type="boolean")
     */
    private $national;
    
    /**
     * @ORM\ManyToOne(targetEntity="Nanotech\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private  $logo;
    
    public function __construct()
    {
        $this->dateEnreg = new \DateTime();

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
     * Set dateEnreg
     *
     * @param \DateTime $dateEnreg
     *
     * @return MoyenPaiement
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

    /**
     * Set lien
     *
     * @param string $lien
     *
     * @return MoyenPaiement
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set secretid
     *
     * @param string $secretid
     *
     * @return MoyenPaiement
     */
    public function setSecretid($secretid)
    {
        $this->secretid = $secretid;

        return $this;
    }

    /**
     * Get secretid
     *
     * @return string
     */
    public function getSecretid()
    {
        return $this->secretid;
    }

    /**
     * Set clientid
     *
     * @param string $clientid
     *
     * @return MoyenPaiement
     */
    public function setClientid($clientid)
    {
        $this->clientid = $clientid;

        return $this;
    }

    /**
     * Get clientid
     *
     * @return string
     */
    public function getClientid()
    {
        return $this->clientid;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return MoyenPaiement
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
     * Set national
     *
     * @param boolean $national
     *
     * @return MoyenPaiement
     */
    public function setNational($national)
    {
        $this->national = $national;

        return $this;
    }

    /**
     * Get national
     *
     * @return bool
     */
    public function getNational()
    {
        return $this->national;
    }
    
    /**
     * Set logo
     *
     * @param \Nanotech\MediaBundle\Entity\Media $logo
     *
     * @return MoyenPaiement
     */
    public function setLogo(\Nanotech\MediaBundle\Entity\Media $logo= null)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return \Nanotech\MediaBundle\Entity\Media
     */
    public function getLogo()
    {
        return $this->logo;
    }
    
    public function __toString() {
        return $this->id? $this->id." ":" ";
        
    }
}

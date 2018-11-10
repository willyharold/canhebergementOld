<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommentaireClient
 *
 * @ORM\Table(name="commentaire_client")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\CommentaireClientRepository")
 */
class CommentaireClient
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="fonction", type="string", length=255)
     */
    private $fonction;

    /**
     * @var string
     *
     * @ORM\Column(name="descriptionFr", type="string", length=255)
     */
    private $descriptionFr;
    
    /**
     * @var string
     *
     * @ORM\Column(name="descriptionEn", type="string", length=255)
     */
    private $descriptionEn;
    
    /**
     * @ORM\OneToOne(targetEntity="Nanotech\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private  $image;
    
    public function __construct()
    {
        $this->dateEnreg = new \DateTime();

    }
    
     public function __toString() {
        return $this->id? $this->id." ":" ";
        
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
     * @return CommentaireClient
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
     * Set nom
     *
     * @param string $nom
     *
     * @return CommentaireClient
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
     * Set fonction
     *
     * @param string $fonction
     *
     * @return CommentaireClient
     */
    public function setFonction($fonction)
    {
        $this->fonction = $fonction;

        return $this;
    }

    /**
     * Get fonction
     *
     * @return string
     */
    public function getFonction()
    {
        return $this->fonction;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return CommentaireClient
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }
    
     /**
     * Set image
     *
     * @param \Nanotech\MediaBundle\Entity\Media $image
     *
     * @return MoyenPaiement
     */
    public function setImage(\Nanotech\MediaBundle\Entity\Media $image= null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Nanotech\MediaBundle\Entity\Media
     */
    public function getImage()
    {
        return $this->image;
    }
    

    /**
     * Set descriptionFr
     *
     * @param string $descriptionFr
     *
     * @return CommentaireClient
     */
    public function setDescriptionFr($descriptionFr)
    {
        $this->descriptionFr = $descriptionFr;

        return $this;
    }

    /**
     * Get descriptionFr
     *
     * @return string
     */
    public function getDescriptionFr()
    {
        return $this->descriptionFr;
    }

    /**
     * Set descriptionEn
     *
     * @param string $descriptionEn
     *
     * @return CommentaireClient
     */
    public function setDescriptionEn($descriptionEn)
    {
        $this->descriptionEn = $descriptionEn;

        return $this;
    }

    /**
     * Get descriptionEn
     *
     * @return string
     */
    public function getDescriptionEn()
    {
        return $this->descriptionEn;
    }
}

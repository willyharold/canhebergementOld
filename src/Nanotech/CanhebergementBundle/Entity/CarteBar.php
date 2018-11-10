<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CarteBar
 *
 * @ORM\Table(name="carte_bar")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\CarteBarRepository")
 */
class CarteBar
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
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var string
     *
     * @ORM\Column(name="famille", type="string", length=255)
     */
    private $famille;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_enreg", type="datetime")
     */
    private $dateEnreg;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_en", type="string", length=255)
     */
    private $nomEn;

    /**
     * @var string
     *
     * @ORM\Column(name="description_en", type="string", length=255, nullable=true)
     */
    private $descriptionEn;

    /**
     * @var string
     *
     * @ORM\Column(name="nom_fr", type="string", length=255)
     */
    private $nomFr;

    /**
     * @var string
     *
     * @ORM\Column(name="description_fr", type="string", length=255, nullable=true)
     */
    private $descriptionFr;
    
    /**
     * @ORM\OneToOne(targetEntity="Nanotech\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private  $image;
    
    /**
    * @ORM\ManyToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\Partenaire")
    * @ORM\JoinColumn(nullable=false) 
    */
    private $partenaire; 

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
     * Set prix
     *
     * @param integer $prix
     *
     * @return CarteBar
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return int
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set famille
     *
     * @param string $famille
     *
     * @return CarteBar
     */
    public function setFamille($famille)
    {
        $this->famille = $famille;

        return $this;
    }

    /**
     * Get famille
     *
     * @return string
     */
    public function getFamille()
    {
        return $this->famille;
    }

    /**
     * Set dateEnreg
     *
     * @param \DateTime $dateEnreg
     *
     * @return CarteBar
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
     * Set nomEn
     *
     * @param string $nomEn
     *
     * @return CarteBar
     */
    public function setNomEn($nomEn)
    {
        $this->nomEn = $nomEn;

        return $this;
    }

    /**
     * Get nomEn
     *
     * @return string
     */
    public function getNomEn()
    {
        return $this->nomEn;
    }

    /**
     * Set descriptionEn
     *
     * @param string $descriptionEn
     *
     * @return CarteBar
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

    /**
     * Set nomFr
     *
     * @param string $nomFr
     *
     * @return CarteBar
     */
    public function setNomFr($nomFr)
    {
        $this->nomFr = $nomFr;

        return $this;
    }

    /**
     * Get nomFr
     *
     * @return string
     */
    public function getNomFr()
    {
        return $this->nomFr;
    }

    /**
     * Set descriptionFr
     *
     * @param string $descriptionFr
     *
     * @return CarteBar
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
     * Constructor
     */
    public function __construct()
    {
        $this->partenaire = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add partenaire
     *
     * @param \Nanotech\Canhebergement\Entity\Partenaire $partenaire
     *
     * @return CarteBar
     */
    public function addPartenaire(\Nanotech\Canhebergement\Entity\Partenaire $partenaire)
    {
        $this->partenaire[] = $partenaire;

        return $this;
    }

    /**
     * Remove partenaire
     *
     * @param \Nanotech\Canhebergement\Entity\Partenaire $partenaire
     */
    public function removePartenaire(\Nanotech\Canhebergement\Entity\Partenaire $partenaire)
    {
        $this->partenaire->removeElement($partenaire);
    }

    /**
     * Get partenaire
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPartenaire()
    {
        return $this->partenaire;
    }

    /**
     * Set partenaire
     *
     * @param \Nanotech\Canhebergement\Entity\Partenaire $partenaire
     *
     * @return CarteBar
     */
    public function setPartenaire(\Nanotech\Canhebergement\Entity\Partenaire $partenaire)
    {
        $this->partenaire = $partenaire;

        return $this;
    }
}

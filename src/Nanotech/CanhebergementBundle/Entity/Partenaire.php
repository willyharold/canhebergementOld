<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Partenaire
 *
 * @ORM\Table(name="partenaire")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\PartenaireRepository")
 */
class Partenaire
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
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var string
     *
     * @ORM\Column(name="quartier", type="string", length=255)
     */
    private $quartier;

    /**
     * @var int
     *
     * @ORM\Column(name="nbr_etoile", type="integer")
     */
    private $nbrEtoile;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_complete", type="string", length=255)
     */
    private $adrComplete;

    /**
     * @var int
     *
     * @ORM\Column(name="num_tel1", type="integer")
     */
    private $numTel1;

    /**
     * @var int
     *
     * @ORM\Column(name="num_tel2", type="integer")
     */
    private $numTel2;

    /**
     * @var int
     *
     * @ORM\Column(name="num_tel3", type="integer")
     */
    private $numTel3;

    /**
     * @var int
     *
     * @ORM\Column(name="fax_tel", type="integer")
     */
    private $faxTel;

    /**
     * @var string
     *
     * @ORM\Column(name="boit_post", type="string", length=255)
     */
    private $boitPost;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_email", type="string", length=255)
     */
    private $adrEmail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_enreg", type="datetime")
     */
    private $dateEnreg;

    /**
     * @var bool
     *
     * @ORM\Column(name="enable", type="boolean")
     */
    private $enable;

    /**
     * @var string
     *
     * @ORM\Column(name="adr_serv", type="string", length=255)
     */
    private $adrServ;

    /**
     * @var string
     *
     * @ORM\Column(name="coordx", type="decimal", precision=10, scale=0)
     */
    private $coordx;

    /**
     * @var string
     *
     * @ORM\Column(name="coordy", type="decimal", precision=10, scale=0)
     */
    private $coordy;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;
    
    /**
     * @var text
     *
     * @ORM\Column(name="descriptionFr", type="text")
     */
    private $descriptionFr;
    /**
     * @var text
     *
     * @ORM\Column(name="descriptionEn", type="text")
     */
    private $descriptionEn;
    
    /**
     * @ORM\OneToOne(targetEntity="Nanotech\MediaBundle\Entity\Gallery", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private  $image;

    /**
     * @ORM\OneToOne(targetEntity="Nanotech\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private  $logo;
    
     /**
    * @ORM\ManyToMany(targetEntity="Nanotech\CanhebergementBundle\Entity\Proximite")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $proximite;
    
     /**
    * @ORM\ManyToMany(targetEntity="Nanotech\CanhebergementBundle\Entity\Service")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $service;
    
    /**
    * @ORM\OneToMany(targetEntity="Nanotech\CanhebergementBundle\Entity\CarteBar",mappedBy="partenaire")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $carteBar;
    
    /**
    * @ORM\OneToMany(targetEntity="Nanotech\CanhebergementBundle\Entity\CarteRestaurant",mappedBy="partenaire")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $carteRestaurant;
    
    /**
    * @ORM\OneToMany(targetEntity="Nanotech\CanhebergementBundle\Entity\CommandeBar",mappedBy="partenaire")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $commandeBar;
    
    /**
    * @ORM\OneToMany(targetEntity="Nanotech\CanhebergementBundle\Entity\CommandeRestaurant",mappedBy="partenaire")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $commandeRestaurant;
   
    public function __construct()
    {
        $this->dateEnreg = new \DateTime();
        $this->pays = "CAMEROUN";

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
     * Set pays
     *
     * @param string $pays
     *
     * @return Partenaire
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
     * Set ville
     *
     * @param string $ville
     *
     * @return Partenaire
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set quartier
     *
     * @param string $quartier
     *
     * @return Partenaire
     */
    public function setQuartier($quartier)
    {
        $this->quartier = $quartier;

        return $this;
    }

    /**
     * Get quartier
     *
     * @return string
     */
    public function getQuartier()
    {
        return $this->quartier;
    }

    /**
     * Set nbrEtoile
     *
     * @param integer $nbrEtoile
     *
     * @return Partenaire
     */
    public function setNbrEtoile($nbrEtoile)
    {
        $this->nbrEtoile = $nbrEtoile;

        return $this;
    }

    /**
     * Get nbrEtoile
     *
     * @return int
     */
    public function getNbrEtoile()
    {
        return $this->nbrEtoile;
    }

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Partenaire
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
     * Set adrComplete
     *
     * @param string $adrComplete
     *
     * @return Partenaire
     */
    public function setAdrComplete($adrComplete)
    {
        $this->adrComplete = $adrComplete;

        return $this;
    }

    /**
     * Get adrComplete
     *
     * @return string
     */
    public function getAdrComplete()
    {
        return $this->adrComplete;
    }

    /**
     * Set numTel1
     *
     * @param integer $numTel1
     *
     * @return Partenaire
     */
    public function setNumTel1($numTel1)
    {
        $this->numTel1 = $numTel1;

        return $this;
    }

    /**
     * Get numTel1
     *
     * @return int
     */
    public function getNumTel1()
    {
        return $this->numTel1;
    }

    /**
     * Set numTel2
     *
     * @param integer $numTel2
     *
     * @return Partenaire
     */
    public function setNumTel2($numTel2)
    {
        $this->numTel2 = $numTel2;

        return $this;
    }

    /**
     * Get numTel2
     *
     * @return int
     */
    public function getNumTel2()
    {
        return $this->numTel2;
    }

    /**
     * Set numTel3
     *
     * @param integer $numTel3
     *
     * @return Partenaire
     */
    public function setNumTel3($numTel3)
    {
        $this->numTel3 = $numTel3;

        return $this;
    }

    /**
     * Get numTel3
     *
     * @return int
     */
    public function getNumTel3()
    {
        return $this->numTel3;
    }

    /**
     * Set faxTel
     *
     * @param integer $faxTel
     *
     * @return Partenaire
     */
    public function setFaxTel($faxTel)
    {
        $this->faxTel = $faxTel;

        return $this;
    }

    /**
     * Get faxTel
     *
     * @return int
     */
    public function getFaxTel()
    {
        return $this->faxTel;
    }

    /**
     * Set boitPost
     *
     * @param string $boitPost
     *
     * @return Partenaire
     */
    public function setBoitPost($boitPost)
    {
        $this->boitPost = $boitPost;

        return $this;
    }

    /**
     * Get boitPost
     *
     * @return string
     */
    public function getBoitPost()
    {
        return $this->boitPost;
    }

    /**
     * Set adrEmail
     *
     * @param string $adrEmail
     *
     * @return Partenaire
     */
    public function setAdrEmail($adrEmail)
    {
        $this->adrEmail = $adrEmail;

        return $this;
    }

    /**
     * Get adrEmail
     *
     * @return string
     */
    public function getAdrEmail()
    {
        return $this->adrEmail;
    }

    /**
     * Set dateEnreg
     *
     * @param \DateTime $dateEnreg
     *
     * @return Partenaire
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
     * Set enable
     *
     * @param boolean $enable
     *
     * @return Partenaire
     */
    public function setEnable($enable)
    {
        $this->enable = $enable;

        return $this;
    }

    /**
     * Get enable
     *
     * @return bool
     */
    public function getEnable()
    {
        return $this->enable;
    }

    /**
     * Set adrServ
     *
     * @param string $adrServ
     *
     * @return Partenaire
     */
    public function setAdrServ($adrServ)
    {
        $this->adrServ = $adrServ;

        return $this;
    }

    /**
     * Get adrServ
     *
     * @return string
     */
    public function getAdrServ()
    {
        return $this->adrServ;
    }

    /**
     * Set coordx
     *
     * @param string $coordx
     *
     * @return Partenaire
     */
    public function setCoordx($coordx)
    {
        $this->coordx = $coordx;

        return $this;
    }

    /**
     * Get coordx
     *
     * @return string
     */
    public function getCoordx()
    {
        return $this->coordx;
    }

    /**
     * Set coordy
     *
     * @param string $coordy
     *
     * @return Partenaire
     */
    public function setCoordy($coordy)
    {
        $this->coordy = $coordy;

        return $this;
    }

    /**
     * Get coordy
     *
     * @return string
     */
    public function getCoordy()
    {
        return $this->coordy;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Partenaire
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get description
     *
     * @return text
     */
    public function getDescription()
    {
        return $this->description;
    }
    
     /**
     * Set description
     *
     * @param text $description
     *
     * @return Partenaire
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
    
    
    /**
     * Set image
     *
     * @param \Nanotech\MediaBundle\Entity\Gallery $image
     *
     * @return MoyenPaiement
     */
    public function setImage(\Nanotech\MediaBundle\Entity\Gallery $image= null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Nanotech\MediaBundle\Entity\Gallery
     */
    public function getImage()
    {
        return $this->image;
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
    
    

    /**
     * Set descriptionFr
     *
     * @param string $descriptionFr
     *
     * @return Partenaire
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
     * @return Partenaire
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
     * Add proximite
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Proximite $proximite
     *
     * @return Partenaire
     */
    public function addProximite(\Nanotech\CanhebergementBundle\Entity\Proximite $proximite)
    {
        $this->proximite[] = $proximite;

        return $this;
    }

    /**
     * Remove proximite
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Proximite $proximite
     */
    public function removeProximite(\Nanotech\CanhebergementBundle\Entity\Proximite $proximite)
    {
        $this->proximite->removeElement($proximite);
    }

    /**
     * Get proximite
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProximite()
    {
        return $this->proximite;
    }

    /**
     * Add service
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Service $service
     *
     * @return Partenaire
     */
    public function addService(\Nanotech\CanhebergementBundle\Entity\Service $service)
    {
        $this->service[] = $service;

        return $this;
    }

    /**
     * Remove service
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Service $service
     */
    public function removeService(\Nanotech\CanhebergementBundle\Entity\Service $service)
    {
        $this->service->removeElement($service);
    }

    /**
     * Get service
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getService()
    {
        return $this->service;
    }

    /**
     * Add carteBar
     *
     * @param \Nanotech\CanhebergementBundle\Entity\CarteBar $carteBar
     *
     * @return Partenaire
     */
    public function addCarteBar(\Nanotech\CanhebergementBundle\Entity\CarteBar $carteBar)
    {
        $this->carteBar[] = $carteBar;

        return $this;
    }

    /**
     * Remove carteBar
     *
     * @param \Nanotech\CanhebergementBundle\Entity\CarteBar $carteBar
     */
    public function removeCarteBar(\Nanotech\CanhebergementBundle\Entity\CarteBar $carteBar)
    {
        $this->carteBar->removeElement($carteBar);
    }

    /**
     * Get carteBar
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarteBar()
    {
        return $this->carteBar;
    }

    /**
     * Add carteRestaurant
     *
     * @param \Nanotech\CanhebergementBundle\Entity\CarteRestaurant $carteRestaurant
     *
     * @return Partenaire
     */
    public function addCarteRestaurant(\Nanotech\CanhebergementBundle\Entity\CarteRestaurant $carteRestaurant)
    {
        $this->carteRestaurant[] = $carteRestaurant;

        return $this;
    }

    /**
     * Remove carteRestaurant
     *
     * @param \Nanotech\CanhebergementBundle\Entity\CarteRestaurant $carteRestaurant
     */
    public function removeCarteRestaurant(\Nanotech\CanhebergementBundle\Entity\CarteRestaurant $carteRestaurant)
    {
        $this->carteRestaurant->removeElement($carteRestaurant);
    }

    /**
     * Get carteRestaurant
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCarteRestaurant()
    {
        return $this->carteRestaurant;
    }

    /**
     * Add commandeBar
     *
     * @param \Nanotech\CanhebergementBundle\Entity\CommandeBar $commandeBar
     *
     * @return Partenaire
     */
    public function addCommandeBar(\Nanotech\CanhebergementBundle\Entity\CommandeBar $commandeBar)
    {
        $this->commandeBar[] = $commandeBar;

        return $this;
    }

    /**
     * Remove commandeBar
     *
     * @param \Nanotech\CanhebergementBundle\Entity\CommandeBar $commandeBar
     */
    public function removeCommandeBar(\Nanotech\CanhebergementBundle\Entity\CommandeBar $commandeBar)
    {
        $this->commandeBar->removeElement($commandeBar);
    }

    /**
     * Get commandeBar
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommandeBar()
    {
        return $this->commandeBar;
    }

    /**
     * Add commandeRestaurant
     *
     * @param \Nanotech\CanhebergementBundle\Entity\CommandeRestaurant $commandeRestaurant
     *
     * @return Partenaire
     */
    public function addCommandeRestaurant(\Nanotech\CanhebergementBundle\Entity\CommandeRestaurant $commandeRestaurant)
    {
        $this->commandeRestaurant[] = $commandeRestaurant;

        return $this;
    }

    /**
     * Remove commandeRestaurant
     *
     * @param \Nanotech\CanhebergementBundle\Entity\CommandeRestaurant $commandeRestaurant
     */
    public function removeCommandeRestaurant(\Nanotech\CanhebergementBundle\Entity\CommandeRestaurant $commandeRestaurant)
    {
        $this->commandeRestaurant->removeElement($commandeRestaurant);
    }

    /**
     * Get commandeRestaurant
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCommandeRestaurant()
    {
        return $this->commandeRestaurant;
    }
}
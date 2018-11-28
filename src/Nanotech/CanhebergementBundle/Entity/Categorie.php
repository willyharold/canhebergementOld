<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Categorie
 *
 * @ORM\Table(name="categorie")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\CategorieRepository")
 */
class Categorie
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
     * @ORM\Column(name="dateEn", type="datetime", unique=true)
     * @ORM\JoinColumn(nullable=true) 
     */
    private $dateEn;

    /**
     * @var string
     *
     * @ORM\Column(name="nomFr", type="string", length=255, unique=true)
     */
    private $nomFr;

     /**
    * @ORM\OneToMany(targetEntity="Nanotech\CanhebergementBundle\Entity\Partenaire",mappedBy="categorie")
    * @ORM\JoinColumn(nullable=true) 
    */
    private $partenaire;
    
    /**
     * @var string
     *
     * @ORM\Column(name="nomEn", type="string", length=255, unique=true)
     */
    private $nomEn;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
    
     public function __construct()
    {
        $this->dateEn = new \DateTime();
        
         }
         
         

    /**
     * Set dateEn
     *
     * @param \DateTime $dateEn
     *
     * @return Categorie
     */
    public function setDateEn($dateEn)
    {
        $this->dateEn = $dateEn;

        return $this;
    }

    /**
     * Get dateEn
     *
     * @return \DateTime
     */
    public function getDateEn()
    {
        return $this->dateEn;
    }

    /**
     * Set nomFr
     *
     * @param string $nomFr
     *
     * @return Categorie
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
     * Set nomEn
     *
     * @param string $nomEn
     *
     * @return Categorie
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
    
    function getPartenaire() {
        return $this->partenaire;
    }

    function setPartenaire($partenaire) {
        $this->partenaire = $partenaire;
    }


}


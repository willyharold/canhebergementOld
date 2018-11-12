<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Commentaire
 *
 * @ORM\Table(name="commentaire")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\CommentaireRepository")
 */
class Commentaire
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
    * @ORM\ManyToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\Partenaire")
    * @ORM\JoinColumn(nullable=false) 
    */
    private $partenaire;
    
    /**
    * @ORM\ManyToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\Internaute")
    * @ORM\JoinColumn(nullable=false) 
    */
    private $internaute;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_enreg", type="datetime")
     */
    private $dateEnreg;
    
    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

  
    
    function getPartenaire() {
        return $this->partenaire;
    }

    function getInternaute() {
        return $this->internaute;
    }

    function getDateEnreg() {
        return $this->dateEnreg;
    }

    function setPartenaire($partenaire) {
        $this->partenaire = $partenaire;
    }

    function setInternaute($internaute) {
        $this->internaute = $internaute;
    }

    function setDateEnreg(\DateTime $dateEnreg) {
        $this->dateEnreg = $dateEnreg;
    }

  public function __construct()
    {
        $this->dateEnreg = new \DateTime();

    }
    
    function getDescription() {
        return $this->description;
    }

    function setDescription($description) {
        $this->description = $description;
    }


}


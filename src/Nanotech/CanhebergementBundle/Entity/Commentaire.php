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
     * @var string
     *
     * @ORM\Column(name="internaute", type="string", length=255)
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
     * Set internaute
     *
     * @param string $internaute
     *
     * @return Commentaire
     */
    public function setInternaute($internaute)
    {
        $this->internaute = $internaute;

        return $this;
    }

    /**
     * Get internaute
     *
     * @return string
     */
    public function getInternaute()
    {
        return $this->internaute;
    }

    /**
     * Set dateEnreg
     *
     * @param \DateTime $dateEnreg
     *
     * @return Commentaire
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
     * Set description
     *
     * @param string $description
     *
     * @return Commentaire
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
     * Set partenaire
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Partenaire $partenaire
     *
     * @return Commentaire
     */
    public function setPartenaire(\Nanotech\CanhebergementBundle\Entity\Partenaire $partenaire)
    {
        $this->partenaire = $partenaire;

        return $this;
    }

    /**
     * Get partenaire
     *
     * @return \Nanotech\CanhebergementBundle\Entity\Partenaire
     */
    public function getPartenaire()
    {
        return $this->partenaire;
    }
}

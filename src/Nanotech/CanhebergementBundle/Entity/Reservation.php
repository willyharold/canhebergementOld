<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reservation")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\ReservationRepository")
 */
class Reservation
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
     * @ORM\Column(name="date_depart", type="date")
     */
    private $dateDepart;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_arrive", type="date")
     */
    private $dateArrive;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_enreg", type="datetime")
     */
    private $dateEnreg;

    /**
    * @ORM\ManyToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\Internaute")
    * @ORM\JoinColumn(nullable=false) 
    */
    private $internaute;
    
    /**
    * @ORM\ManyToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\Piece")
    * @ORM\JoinColumn(nullable=false) 
    */
    private $piece;

    /**
     * @var bool
     *
     * @ORM\Column(name="confirme", type="boolean")
     */
    private $confirme;
    
     public function __construct()
    {
        $this->dateEnreg = new \DateTime();
        $this->dateDepart = new \DateTime();
        $this->dateArrive = new \DateTime();
        $this->confirme = false;

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
     * Set dateDepart
     *
     * @param \DateTime $dateDepart
     *
     * @return Reservation
     */
    public function setDateDepart($dateDepart)
    {
        $this->dateDepart = $dateDepart;

        return $this;
    }

    /**
     * Get dateDepart
     *
     * @return \DateTime
     */
    public function getDateDepart()
    {
        return $this->dateDepart;
    }

    /**
     * Set dateArrive
     *
     * @param \DateTime $dateArrive
     *
     * @return Reservation
     */
    public function setDateArrive($dateArrive)
    {
        $this->dateArrive = $dateArrive;

        return $this;
    }

    /**
     * Get dateArrive
     *
     * @return \DateTime
     */
    public function getDateArrive()
    {
        return $this->dateArrive;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Reservation
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return integer
     */
    public function getQuantite()
    {
        return $this->quantite;
    }

    /**
     * Set dateEnreg
     *
     * @param \DateTime $dateEnreg
     *
     * @return Reservation
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
     * Set confirme
     *
     * @param boolean $confirme
     *
     * @return Reservation
     */
    public function setConfirme($confirme)
    {
        $this->confirme = $confirme;

        return $this;
    }

    /**
     * Get confirme
     *
     * @return boolean
     */
    public function getConfirme()
    {
        return $this->confirme;
    }

    /**
     * Set internaute
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Internaute $internaute
     *
     * @return Reservation
     */
    public function setInternaute(\Nanotech\CanhebergementBundle\Entity\Internaute $internaute)
    {
        $this->internaute = $internaute;

        return $this;
    }

    /**
     * Get internaute
     *
     * @return \Nanotech\CanhebergementBundle\Entity\Internaute
     */
    public function getInternaute()
    {
        return $this->internaute;
    }

    /**
     * Set piece
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Piece $piece
     *
     * @return Reservation
     */
    public function setPiece(\Nanotech\CanhebergementBundle\Entity\Piece $piece)
    {
        $this->piece = $piece;

        return $this;
    }

    /**
     * Get piece
     *
     * @return \Nanotech\CanhebergementBundle\Entity\Piece
     */
    public function getPiece()
    {
        return $this->piece;
    }
    
    public function __toString() {
        return "".$this->id;
    }
}

<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReservationConfirme
 *
 * @ORM\Table(name="reservation_confirme")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\ReservationConfirmeRepository")
 */
class ReservationConfirme
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
    * @ORM\ManyToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\MoyenPaiement", cascade={"persist"})
    * @ORM\JoinColumn(nullable=true) 
    */
    private $moyenPaiement;
    
    /**
    * @ORM\ManyToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\Reservation", cascade={"all"})
    * @ORM\JoinColumn(nullable=false) 
    */
    private $reservation; 
    
    /**
     * @var int
     *
     * @ORM\Column(name="prix", type="integer")
     */
    private $prix;

    /**
     * @var bool
     *
     * @ORM\Column(name="type", type="string", length=255,nullable=false)
     */
    private $type;

    /**
     * @var bool
     *
     * @ORM\Column(name="transaction", type="string", length=255,nullable=false)
     */
    private $transaction;
    
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
     * Set dateEnreg
     *
     * @param \DateTime $dateEnreg
     *
     * @return ReservationConfirme
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
     * Set prix
     *
     * @param integer $prix
     *
     * @return ReservationConfirme
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return integer
     */
    public function getPrix()
    {
        return $this->prix;
    }

    
    /**
     * Set moyenPaiement
     *
     * @param \Nanotech\CanhebergementBundle\Entity\MoyenPaiement $moyenPaiement
     *
     * @return ReservationConfirme
     */
    public function setMoyenPaiement(\Nanotech\CanhebergementBundle\Entity\MoyenPaiement $moyenPaiement)
    {
        $this->moyenPaiement = $moyenPaiement;

        return $this;
    }

    /**
     * Get moyenPaiement
     *
     * @return \Nanotech\CanhebergementBundle\Entity\MoyenPaiement
     */
    public function getMoyenPaiement()
    {
        return $this->moyenPaiement;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return ReservationConfirme
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set reservation
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Reservation $reservation
     *
     * @return ReservationConfirme
     */
    public function setReservation(\Nanotech\CanhebergementBundle\Entity\Reservation $reservation)
    {
        $this->reservation = $reservation;

        return $this;
    }

    /**
     * Get reservation
     *
     * @return \Nanotech\CanhebergementBundle\Entity\Reservation
     */
    public function getReservation()
    {
        return $this->reservation;
    }

    /**
     * Set transaction
     *
     * @param string $transaction
     *
     * @return ReservationConfirme
     */
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Get transaction
     *
     * @return string
     */
    public function getTransaction()
    {
        return $this->transaction;
    }
}

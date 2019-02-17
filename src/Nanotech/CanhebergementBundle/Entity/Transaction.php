<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Transaction
 *
 * @ORM\Table(name="transaction")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\TransactionRepository")
 */
class Transaction
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
     * @ORM\Column(name="uuid", type="string", length=255, unique=true)
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(name="status", type="string", length=255)
     */
    private $status;
/**
    * @ORM\ManyToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\MoyenPaiement", cascade={"persist"})
    * @ORM\JoinColumn(nullable=true) 
    */
    private $moyenPaiement;
    
    /**
    * @ORM\ManyToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\Reservation", cascade={"persist"})
    * @ORM\JoinColumn(nullable=false) 
    */
    private $reservation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_enreg", type="datetime",nullable=true)
     */
    private $dateEnreg;

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
     * Set uuid
     *
     * @param string $uuid
     *
     * @return Transaction
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Transaction
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set moyenPaiement
     *
     * @param \Nanotech\CanhebergementBundle\Entity\MoyenPaiement $moyenPaiement
     *
     * @return Transaction
     */
    public function setMoyenPaiement(\Nanotech\CanhebergementBundle\Entity\MoyenPaiement $moyenPaiement = null)
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
     * Set reservation
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Reservation $reservation
     *
     * @return Transaction
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
     * Set dateEnreg
     *
     * @param \DateTime $dateEnreg
     *
     * @return Transaction
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
}

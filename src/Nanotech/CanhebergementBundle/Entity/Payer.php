<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Payer
 *
 * @ORM\Table(name="payer")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\PayerRepository")
 */
class Payer
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
    * @ORM\ManyToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\MoyenPaiement")
    * @ORM\JoinColumn(nullable=false) 
    */
    private $MoyenPaiement; 
    
    /**
    * @ORM\ManyToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\Piece")
    * @ORM\JoinColumn(nullable=false) 
    */
    private $Piece; 
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
     * @return Payer
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
     * Set dateEnreg
     *
     * @param \DateTime $dateEnreg
     *
     * @return Payer
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
     * Set internaute
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Internaute $internaute
     *
     * @return Payer
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
     * Set moyenPaiement
     *
     * @param \Nanotech\CanhebergementBundle\Entity\MoyenPaiement $moyenPaiement
     *
     * @return Payer
     */
    public function setMoyenPaiement(\Nanotech\CanhebergementBundle\Entity\MoyenPaiement $moyenPaiement)
    {
        $this->MoyenPaiement = $moyenPaiement;

        return $this;
    }

    /**
     * Get moyenPaiement
     *
     * @return \Nanotech\CanhebergementBundle\Entity\MoyenPaiement
     */
    public function getMoyenPaiement()
    {
        return $this->MoyenPaiement;
    }

    /**
     * Set piece
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Piece $piece
     *
     * @return Payer
     */
    public function setPiece(\Nanotech\CanhebergementBundle\Entity\Piece $piece)
    {
        $this->Piece = $piece;

        return $this;
    }

    /**
     * Get piece
     *
     * @return \Nanotech\CanhebergementBundle\Entity\Piece
     */
    public function getPiece()
    {
        return $this->Piece;
    }
}

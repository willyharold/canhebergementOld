<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Banniere
 *
 * @ORM\Table(name="banniere")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\BanniereRepository")
 */
class Banniere
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
     * @var int
     *
     * @ORM\Column(name="position", type="integer", unique=true)
     */
    private $position;

    /**
     * @ORM\OneToOne(targetEntity="Nanotech\MediaBundle\Entity\Media", cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private  $image;
    
    
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
     * Set dateEnreg
     *
     * @param \DateTime $dateEnreg
     *
     * @return Banniere
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
     * Set position
     *
     * @param integer $position
     *
     * @return Banniere
     */
    public function setPosition($position)
    {
        $this->position = $position;

        return $this;
    }

    /**
     * Get position
     *
     * @return int
     */
    public function getPosition()
    {
        return $this->position;
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
}

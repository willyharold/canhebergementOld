<?php

namespace Nanotech\CanhebergementBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Parametre
 *
 * @ORM\Table(name="parametre")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\ParametreRepository")
 */
class Parametre
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
     * @var string
     *
     * @ORM\Column(name="devise", type="string", length=1)
     */
    private $devise;

    /**
     * @var string
     *
     * @ORM\Column(name="titre_fr", type="string", length=255)
     */
    private $titre_fr;
    
     /**
     * @var string
     *
     * @ORM\Column(name="titre_en", type="string", length=255)
     */
    private $titre_en;

    public function __construct()
    {
        $this->dateEnreg = new \DateTime();

    }

    /**
     * Get id
     *
     * @return int
     * 
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
     * @return Parametre
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
     * Set devise
     *
     * @param string $devise
     *
     * @return Parametre
     */
    public function setDevise($devise)
    {
        $this->devise = $devise;

        return $this;
    }

    /**
     * Get devise
     *
     * @return string
     */
    public function getDevise()
    {
        return $this->devise;
    }

    /**
     * Set tire
     *
     * @param string $tire
     *
     * @return Parametre
     */
    public function setTire($tire)
    {
        $this->tire = $tire;

        return $this;
    }

    /**
     * Get tire
     *
     * @return string
     */
    public function getTire()
    {
        return $this->tire;
    }

    /**
     * Set titreFr
     *
     * @param string $titreFr
     *
     * @return Parametre
     */
    public function setTitreFr($titreFr)
    {
        $this->titre_fr = $titreFr;

        return $this;
    }

    /**
     * Get titreFr
     *
     * @return string
     */
    public function getTitreFr()
    {
        return $this->titre_fr;
    }

    /**
     * Set titreEn
     *
     * @param string $titreEn
     *
     * @return Parametre
     */
    public function setTitreEn($titreEn)
    {
        $this->titre_en = $titreEn;

        return $this;
    }

    /**
     * Get titreEn
     *
     * @return string
     */
    public function getTitreEn()
    {
        return $this->titre_en;
    }
}

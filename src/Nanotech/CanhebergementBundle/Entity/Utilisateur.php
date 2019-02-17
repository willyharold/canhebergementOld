<?php

namespace Nanotech\CanhebergementBundle\Entity;


use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Utilisateur
 *
 * @ORM\Table(name="utilisateur")
 * @ORM\Entity(repositoryClass="Nanotech\CanhebergementBundle\Repository\UtilisateurRepository")
 * @UniqueEntity(fields="username", message="Un utilisateur existe déjà avec ce nom.")
 * @UniqueEntity(fields="email", message="l'email existe déjà.")
 */
class Utilisateur extends BaseUser
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, nullable=true)
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255, nullable=true)
     */
    private $sexe;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateNaissance", type="date", nullable=true)
     */
    private $dateNaissance;

    /**
     * @var int
     *
     * @ORM\Column(name="telephone", type="integer", nullable=true)
     */
    private $telephone;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateEnreg", type="datetime")
     */
    private $dateEnreg;
    
    protected $email;    
    
    protected $password;

    protected $username;

    protected  $enabled;

    /**
     * @ORM\ManyToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\Partenaire" , cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $partenaire;

    /**
     * @ORM\OneToOne(targetEntity="Nanotech\CanhebergementBundle\Entity\Internaute" , cascade={"all"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $internaute;

    public function __construct()
    {
        parent::__construct();
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
     * Set nom
     *
     * @param string $nom
     *
     * @return Utilisateur
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
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return Utilisateur
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }

    /**
     * Set dateNaissance
     *
     * @param \DateTime $dateNaissance
     *
     * @return Utilisateur
     */
    public function setDateNaissance($dateNaissance)
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    /**
     * Get dateNaissance
     *
     * @return \DateTime
     */
    public function getDateNaissance()
    {
        return $this->dateNaissance;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return Utilisateur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return int
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set dateEnreg
     *
     * @param \DateTime $dateEnreg
     *
     * @return Utilisateur
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
     * Set partenaire
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Partenaire $partenaire
     *
     * @return Utilisateur
     */
    public function setPartenaire(\Nanotech\CanhebergementBundle\Entity\Partenaire $partenaire = null)
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

    /**
     * Set internaute
     *
     * @param \Nanotech\CanhebergementBundle\Entity\Internaute $internaute
     *
     * @return Utilisateur
     */
    public function setInternaute(\Nanotech\CanhebergementBundle\Entity\Internaute $internaute = null)
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
}

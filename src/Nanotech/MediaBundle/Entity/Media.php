<?php

namespace Nanotech\MediaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Sonata\MediaBundle\Entity\BaseMedia as BaseMedia;

/**
 *
 * @ORM\Table(name="media_media")
 * @ORM\Entity
 */
class Media extends BaseMedia{

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="Nanotech\MediaBundle\Entity\Gallery")
     * @ORM\JoinColumn(nullable=true)
     */
    private $gallery;
    
     
   
    public function __construct() {
    }

    /**
     * Get idPhoto
     *
     * @return integer 
     */
    public function getId() {
        return $this->id;
    }

    

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Media
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Add galleryHasMedia
     *
     * @param \Nanotech\MediaBundle\Entity\GalleryHasMedia $galleryHasMedia
     *
     * @return Media
     */
    public function addGalleryHasMedia(\Nanotech\MediaBundle\Entity\GalleryHasMedia $galleryHasMedia)
    {
        $this->galleryHasMedias[] = $galleryHasMedia;

        return $this;
    }

    /**
     * Remove galleryHasMedia
     *
     * @param \Nanotech\MediaBundle\Entity\GalleryHasMedia $galleryHasMedia
     */
    public function removeGalleryHasMedia(\Nanotech\MediaBundle\Entity\GalleryHasMedia $galleryHasMedia)
    {
        $this->galleryHasMedias->removeElement($galleryHasMedia);
    }

    /**
     * Set gallery
     *
     * @param \Nanotech\MediaBundle\Entity\Gallery $gallery
     *
     * @return Media
     */
    public function setGallery(\Nanotech\MediaBundle\Entity\Gallery $gallery = null)
    {
        $this->gallery = $gallery;

        return $this;
    }

    /**
     * Get gallery
     *
     * @return \Nanotech\MediaBundle\Entity\Gallery
     */
    public function getGallery()
    {
        return $this->gallery;
    }
    
   

}

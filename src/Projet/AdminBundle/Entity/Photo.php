<?php

namespace Projet\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Image\ImageInterface;
/**
 * Photo
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Projet\AdminBundle\Entity\PhotoRepository")
 */
class Photo
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="libelle", type="string", length=255)
     */
    private $libelle;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string", length=255)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Projet\AdminBundle\Entity\Produit")
     * @ORM\JoinColumn(nullable=true)
     */
    private $produit;

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
     * Set libelle
     *
     * @param string $libelle
     * @return Photo
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string 
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Photo
     */
    public function setImage($image)
    {
    	if($image != ""){
        	$this->image = $image;
    	}

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set produit
     *
     * @param \Projet\AdminBundle\Entity\Produit $produit
     * @return Photo
     */
    public function setProduit(\Projet\AdminBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \Projet\AdminBundle\Entity\Produit 
     */
    public function getProduit()
    {
        return $this->produit;
    }

    
    
    
    
    
    public function getFullUrlPath() {
    	return null === $this->image ? null : $this->getUploadRootDir(). $this->image;
    }
    
    protected function getUploadRootDir() {
    	// the absolute directory path where uploaded documents should be saved
    	return $this->getTmpUploadRootDir().$this->getProduit()->getId()."/";
    }
    
    protected function getTmpUploadRootDir() {
    	// the absolute directory path where uploaded documents should be saved
    	return __DIR__ . '/../../../../web/upload/';
    }
    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function uploadUrl() {
    	if ($this->image != NULL and !is_string($this->image)) {
    		if(!$this->id){
    			$this->image->move($this->getTmpUploadRootDir(), $this->image->getClientOriginalName());
    		}else{
    			$this->image->move($this->getUploadRootDir()."big", $this->image->getClientOriginalName());
    		}
    		$this->setImage($this->image->getClientOriginalName());
    	}else{
    		return;
    	}
    
    }
    
    
    /**
     * @ORM\PostPersist()
     */
    public function moveUrl()
    {
    	if ($this->image != NULL) {
    		if(!is_dir($this->getUploadRootDir())){
    			mkdir($this->getUploadRootDir());
    			mkdir($this->getUploadRootDir()."/big");
    			mkdir($this->getUploadRootDir()."/small");
    		}
    		copy($this->getTmpUploadRootDir().$this->image, $this->getUploadRootDir().'big/'.$this->image);
    		copy($this->getTmpUploadRootDir().$this->image, $this->getUploadRootDir().'small/'.$this->image);
    
    		$imagine = new Imagine\Gd\Imagine();
    		$mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
    		$image   = $imagine->open($this->getUploadRootDir().'small/'.$this->image);
    		$image->thumbnail(new Box(200, 200), $mode)
    		->save($this->getUploadRootDir()."small/".$this->image);
    
    		unlink($this->getTmpUploadRootDir().$this->image);
    	}else{
    		return;
    	}
    }
    
    /**
     * @ORM\PostUpdate()
     */
    public function moveUrlUpdate()
    {
    	if ($this->image != NULL) {
    		if(!is_dir($this->getUploadRootDir()."/small")){
    			mkdir($this->getUploadRootDir()."/small");
    		}
    		if(!is_dir($this->getUploadRootDir()."/big")){
    			mkdir($this->getUploadRootDir()."/big");
    		}
    		copy($this->getUploadRootDir().'big/'.$this->image, $this->getUploadRootDir().'big/'.$this->image);
    		copy($this->getUploadRootDir().'big/'.$this->image, $this->getUploadRootDir().'small/'.$this->image);
    
    		$imagine = new Imagine\Gd\Imagine();
    		$mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
    		$image   = $imagine->open($this->getUploadRootDir().'small/'.$this->image);
    		$image->thumbnail(new Box(200, 200), $mode)
    		->save($this->getUploadRootDir()."small/".$this->image);
    
    		//unlink($this->getTmpUploadRootDir().$this->image);
    	}else{
    		return;
    	}
    }
    public function delTree($dir) {
    	$files = array_diff(scandir($dir), array('.','..'));
    	foreach ($files as $file) {
    		(is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
    	}
    	//return rmdir($dir); SUPPRIMER LE DOSSIER PERE
    }
    /**
     * @ORM\PreRemove()
     */
    public function removeUrl()
    {
    	$this->delTree($this->getUploadRootDir());
    }
    
}

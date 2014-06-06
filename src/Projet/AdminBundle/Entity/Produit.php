<?php

namespace Projet\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Imagine;
use Imagine\Image\Box;
use Imagine\Image\Point;
use Imagine\Image\ImageInterface;

use Symfony\Component\Validator\Constraints as Assert;



/**
 * Produit
 *
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks
 * @ORM\Entity(repositoryClass="Projet\AdminBundle\Entity\ProduitRepository")
 */
class Produit
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
     * @var float
     *
     * @ORM\Column(name="prix_ht", type="float")
     */
    private $prixHt;

    /**
     * @var float
     *
     * @ORM\Column(name="prix_ttc", type="float")
     */
    private $prixTtc;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_keywords", type="text")
     */
    private $metaKeywords;

    /**
     * @var string
     *
     * @ORM\Column(name="meta_description", type="text")
     */
    private $metaDescription;

    /**
     * @var string
     *
     * @ORM\Column(name="reference", type="string", length=255)
     */
    private $reference;

    /**
     * @var string
     *
     * @ORM\Column(name="photo_principale", type="string", length=255)
     */
    private $photoPrincipale;

    /**
     * @var string
     *
     * @ORM\Column(name="dossier", type="string", length=255)
     */
    private $dossier;

    /**
     * @var string
     * @Assert\Url()
     *
     * @ORM\Column(name="lien", type="string", length=255)
     */
    private $lien;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_maj", type="datetime")
     */
    private $dateMaj;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disponible", type="boolean", nullable=true)
     */
    private $disponible;
    
    /**
     * @ORM\ManyToOne(targetEntity="Projet\AdminBundle\Entity\CategorieProduit")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    private $oldLibelle;
    
    public function __construct(){
    	$this->dateCreation = new \DateTime();
    	$this->dateMaj = new \DateTime();
    	$this->dossier = "Dossier->Image";
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
     * Set libelle
     *
     * @param string $libelle
     * @return Produit
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
     * Set prixHt
     *
     * @param float $prixHt
     * @return Produit
     */
    public function setPrixHt($prixHt)
    {
        $this->prixHt = $prixHt;

        return $this;
    }

    /**
     * Get prixHt
     *
     * @return float 
     */
    public function getPrixHt()
    {
        return $this->prixHt;
    }

    /**
     * Set prixTtc
     *
     * @param float $prixTtc
     * @return Produit
     */
    public function setPrixTtc($prixTtc)
    {
        $this->prixTtc = $prixTtc;

        return $this;
    }

    /**
     * Get prixTtc
     *
     * @return float 
     */
    public function getPrixTtc()
    {
        return $this->prixTtc;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Produit
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
     * Set metaKeywords
     *
     * @param string $metaKeywords
     * @return Produit
     */
    public function setMetaKeywords($metaKeywords)
    {
        $this->metaKeywords = $metaKeywords;

        return $this;
    }

    /**
     * Get metaKeywords
     *
     * @return string 
     */
    public function getMetaKeywords()
    {
        return $this->metaKeywords;
    }

    /**
     * Set metaDescription
     *
     * @param string $metaDescription
     * @return Produit
     */
    public function setMetaDescription($metaDescription)
    {
        $this->metaDescription = $metaDescription;

        return $this;
    }

    /**
     * Get metaDescription
     *
     * @return string 
     */
    public function getMetaDescription()
    {
        return $this->metaDescription;
    }

    /**
     * Set reference
     *
     * @param string $reference
     * @return Produit
     */
    public function setReference($reference)
    {
        $this->reference = $reference;

        return $this;
    }

    /**
     * Get reference
     *
     * @return string 
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * Set photoPrincipale
     *
     * @param string $photoPrincipale
     * @return Produit
     */
    public function setPhotoPrincipale($photoPrincipale)
    {
    	if($photoPrincipale){
        	$this->photoPrincipale = $photoPrincipale;
    	}
        return $this;
    }

    /**
     * Get photoPrincipale
     *
     * @return string 
     */
    public function getPhotoPrincipale()
    {
        return $this->photoPrincipale;
    }

    /**
     * Set dossier
     *
     * @param string $dossier
     * @return Produit
     */
    public function setDossier($dossier)
    {
        $this->dossier = $dossier;

        return $this;
    }

    /**
     * Get dossier
     *
     * @return string 
     */
    public function getDossier()
    {
        return $this->dossier;
    }

    /**
     * Set lien
     *
     * @param string $lien
     * @return Produit
     */
    public function setLien($lien)
    {
        $this->lien = $lien;

        return $this;
    }

    /**
     * Get lien
     *
     * @return string 
     */
    public function getLien()
    {
        return $this->lien;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Produit
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set dateMaj
     *
     * @param \DateTime $dateMaj
     * @return Produit
     */
    public function setDateMaj($dateMaj)
    {
        $this->dateMaj = $dateMaj;

        return $this;
    }

    /**
     * Get dateMaj
     *
     * @return \DateTime 
     */
    public function getDateMaj()
    {
        return $this->dateMaj;
    }

    /**
     * Set disponible
     *
     * @param boolean $disponible
     * @return Produit
     */
    public function setDisponible($disponible)
    {
        $this->disponible = $disponible;

        return $this;
    }

    /**
     * Get disponible
     *
     * @return boolean 
     */
    public function getDisponible()
    {
        return $this->disponible;
    }

    public function setOldLibelle($old){
    	$this->oldLibelle = $old;
    	return $this;
    }

    public function getOldLibelle(){
    	return $this->oldLibelle;
    }

    /**
     * Set categorie
     *
     * @param \Projet\AdminBundle\Entity\CategorieProduit $categorie
     * @return Produit
     */
    public function setCategorie(\Projet\AdminBundle\Entity\CategorieProduit $categorie)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \Projet\AdminBundle\Entity\CategorieProduit 
     */
    public function getCategorie()
    {
        return $this->categorie;
    }
    
    
    public function getFullUrlPath() {
    	return null === $this->photoPrincipale ? null : $this->getUploadRootDir(). $this->photoPrincipale;
    }
    
    protected function getUploadRootDir() {
    	// the absolute directory path where uploaded documents should be saved
    	return $this->getTmpUploadRootDir().$this->getId()."/";
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
    	if ($this->photoPrincipale != NULL and !is_string($this->photoPrincipale)) {
    		if(!$this->id){
    			$this->photoPrincipale->move($this->getTmpUploadRootDir(), $this->photoPrincipale->getClientOriginalName());
    		}else{
    			$this->photoPrincipale->move($this->getUploadRootDir()."big", $this->photoPrincipale->getClientOriginalName());
    		}
    		$this->setPhotoPrincipale($this->photoPrincipale->getClientOriginalName());
    	}else{
    		return;
    	}
    
    }
    

    /**
     * @ORM\PostPersist()
     */
    public function moveUrl()
    {
    	if ($this->photoPrincipale != NULL) {
    		if(!is_dir($this->getUploadRootDir())){
    			mkdir($this->getUploadRootDir());
    			mkdir($this->getUploadRootDir()."/big");
    			mkdir($this->getUploadRootDir()."/small");
    		}
    		copy($this->getTmpUploadRootDir().$this->photoPrincipale, $this->getUploadRootDir().'big/'.$this->photoPrincipale);
    		copy($this->getTmpUploadRootDir().$this->photoPrincipale, $this->getUploadRootDir().'small/'.$this->photoPrincipale);
    
    		$imagine = new Imagine\Gd\Imagine();
    		$mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
    		$image   = $imagine->open($this->getUploadRootDir().'small/'.$this->photoPrincipale);
    		$image->thumbnail(new Box(200, 200), $mode)
    		->save($this->getUploadRootDir()."small/".$this->photoPrincipale);
    
    		unlink($this->getTmpUploadRootDir().$this->photoPrincipale);
    	}else{
    		return;
    	}
    }
    
    /**
     * @ORM\PostUpdate()
     */
    public function moveUrlUpdate()
    {
    	if ($this->photoPrincipale != NULL) {
    		if(!is_dir($this->getUploadRootDir()."/small")){
    			mkdir($this->getUploadRootDir()."/small");
    		}
    		if(!is_dir($this->getUploadRootDir()."/big")){
    			mkdir($this->getUploadRootDir()."/big");
    		}
    		copy($this->getUploadRootDir().'big/'.$this->photoPrincipale, $this->getUploadRootDir().'big/'.$this->photoPrincipale);
    		copy($this->getUploadRootDir().'big/'.$this->photoPrincipale, $this->getUploadRootDir().'small/'.$this->photoPrincipale);
    
    		$imagine = new Imagine\Gd\Imagine();
    		$mode    = Imagine\Image\ImageInterface::THUMBNAIL_INSET;
    		$image   = $imagine->open($this->getUploadRootDir().'small/'.$this->photoPrincipale);
    		$image->thumbnail(new Box(200, 200), $mode)
    		->save($this->getUploadRootDir()."small/".$this->photoPrincipale);
    
    		//unlink($this->getTmpUploadRootDir().$this->photoPrincipale);
    	}else{
    		return;
    	}
    }
    public function delTree($dir) {
    	$files = array_diff(scandir($dir), array('.','..'));
    	foreach ($files as $file) {
    		(is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
    	}
    	return rmdir($dir);
    }
    /**
     * @ORM\PreRemove()
     */
    public function removeUrl()
    {
    	$this->delTree($this->getUploadRootDir());    
    }
    
    
    
    
    
    
    
    
}

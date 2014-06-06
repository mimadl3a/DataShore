<?php

namespace Projet\AdminBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * InfoSuppProduit
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Projet\AdminBundle\Entity\InfoSuppProduitRepository")
 */
class InfoSuppProduit
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
     * @ORM\Column(name="couleur", type="string", length=255)
     */
    private $couleur;

    /**
     * @var string
     *
     * @ORM\Column(name="taille", type="string", length=255)
     */
    private $taille;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantite", type="smallint")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="Projet\AdminBundle\Entity\Produit")
     * @ORM\JoinColumn(nullable=false)
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
     * Set couleur
     *
     * @param string $couleur
     * @return InfoSuppProduit
     */
    public function setCouleur($couleur)
    {
        $this->couleur = $couleur;

        return $this;
    }

    /**
     * Get couleur
     *
     * @return string 
     */
    public function getCouleur()
    {
        return $this->couleur;
    }

    /**
     * Set taille
     *
     * @param string $taille
     * @return InfoSuppProduit
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return string 
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     * @return InfoSuppProduit
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
     * Set produit
     *
     * @param \Projet\AdminBundle\Entity\Produit $produit
     * @return InfoSuppProduit
     */
    public function setProduit(\Projet\AdminBundle\Entity\Produit $produit)
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
}

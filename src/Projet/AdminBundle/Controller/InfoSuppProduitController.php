<?php

namespace Projet\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Projet\AdminBundle\Form\InfoSuppProduitType;
use Projet\AdminBundle\Entity\InfoSuppProduit;
use Projet\AdminBundle\Entity\Produit;
use Doctrine\DBAL\DBALException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpFoundation\Session\Session;

class InfoSuppProduitController extends Controller
{
	public function indexAction(Produit $p){
		$em = $this->getDoctrine()->getManager();
		$liste = $em->getRepository("ProjetAdminBundle:InfoSuppProduit")->findAll();
		
		$infosupp = new InfoSuppProduit();
		$form = $this->createForm(new InfoSuppProduitType(), $infosupp);
		return $this->render("ProjetAdminBundle:InfoSuppProduit:index.html.twig",
			array(
				"form" => $form->createView(),
				"produit" => $p,
				"liste" => $liste,
			)
		);		
		
	}
    
	
	public function ajouterAction(Request $request, $id_prod){
		$em = $this->getDoctrine()->getManager();
		$if = new InfoSuppProduit();
		$form = $this->createForm(new InfoSuppProduitType(), $if);
		$form->handleRequest($request);
		if($form->isValid()){
			$infosupp = $form->getData();
			$tmp = $em->getRepository("ProjetAdminBundle:InfoSuppProduit")->findInfoByCouleurTaille(
					$infosupp->getCouleur(),
					$infosupp->getTaille()
			);
			$p = $em->getRepository("ProjetAdminBundle:Produit")->findOneById($id_prod);
			$infosupp->setProduit($p);
				
			$em->persist($infosupp);
			$em->flush();
			return $this->redirect($this->generateUrl("Info_supp_produit",array('id'=> $id_prod)));
		}
		return $this->render("ProjetAdminBundle:InfoSuppProduit:ajouter.html.twig",
			array(
				"form" => $form->createView(),
				"id_produit" => $id_prod,
			)
		);
	}

	//SUPPRESSION DES INFOS SUPP PRODUIT
	public function supprimerAction($id){
		 
		$tme = $this->getDoctrine()->getRepository("ProjetAdminBundle:InfoSuppProduit");
		$tmp = $tme->findOneById($id);
		if($tmp){
			try{
				$em = $this->getDoctrine()->getManager();
				$em->remove($tmp);
				$em->flush();
			}catch(\Exception $e){
				$this->get("session")
				->getFlashBag()
				->add("dbal-erreur", "Erreur, impossible de supprimer cette info <strong></strong>!");
			}
	
			return $this->redirect($this->generateUrl("Info_supp_produit",array('id'=>$tmp->getProduit()->getId())));
		}else{
			$this->get("session")->getFlashBag()->add("erreur", "Erreur, Categorie introuvable !");
			return $this->redirect($this->generateUrl("Info_supp_produit",array('id'=>$tmp->getProduit()->getId())));
		}
	}
	
	//MODIFICATION DES INFOS SUPP PRODUIT
	public function modifierAction($id, Request $request,$id_prod){
		$repo = $this->getDoctrine()->getManager()->getRepository("ProjetAdminBundle:InfoSuppProduit");
		$if = $repo->findOneById($id);
		if($if){
			$form = $this->createForm(new InfoSuppProduitType(), $if);
			
			$repo = $this->getDoctrine()->getManager()->getRepository("ProjetAdminBundle:InfoSuppProduit");
			
			$form->handleRequest($request);
			if($form->isValid()){
				$if = $form->getData();
				$em = $this->getDoctrine()->getManager();
				$em->persist($if);
				$em->flush();
			}
			
			return $this->render("ProjetAdminBundle:InfoSuppProduit:modifier.html.twig",
				array(
					"form" => $form->createView(),
					"info" => $if,
				)	
			);
		}else{
			$this->get('session')->getFlashBag()->add("erreur", "Erreur, entite introuvable !");
			return $this->redirect($this->generateUrl("Info_supp_produit",array('id'=>$id_prod)));
		}
		
	}
	
	
	
	
	
	
	
    
    private function getErrorMessages(\Symfony\Component\Form\Form $form) {
    	$errors = array();
    
    	foreach ($form->getErrors() as $key => $error) {
    		$errors[] = $error->getMessage();
    	}
    
    	foreach ($form->all() as $child) {
    		if (!$child->isValid()) {
    			$errors[$child->getName()] = $this->getErrorMessages($child);
    		}
    	}
    
    	return $errors;
    }







}

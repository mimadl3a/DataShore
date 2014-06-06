<?php

namespace Projet\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Projet\AdminBundle\Entity\Cgv;
use Projet\AdminBundle\Form\CgvType;

class CgvController extends Controller{
	
	public function indexAction(){
		$em = $this->getDoctrine()->getManager()->getRepository("ProjetAdminBundle:Cgv");
		$liste = $em->findAll();
		
		return $this->render("ProjetAdminBundle:Cgv:index.html.twig",array(
			'liste' => $liste,
		));
		
	}
	
	public function ajaxAction(Request $request){
		$em    = $this->get('doctrine.orm.entity_manager');
		$dql   = "SELECT a FROM ProjetAdminBundle:Cgv a WHERE a.titre LIKE '%".$request->get("variable")."%'";
		$query = $em->createQuery($dql);
		return $this->render("ProjetAdminBundle:Cgv:ajax.html.twig",array(
				'liste' => $query->getResult(),
		));
	}
	
	public function ajouterAction(Request $request){
		$cgv = new Cgv();
		$form = $this->createForm(new CgvType(), $cgv);
		$form->handleRequest($request);
		if($form->isValid()){
			$cgv = $form->getData();			
			$em = $this->getDoctrine()->getManager();
			$em->persist($cgv);
			$em->flush();
			return $this->redirect($this->generateUrl("Liste_cgv"));
		}
		return $this->render("ProjetAdminBundle:Cgv:ajouter.html.twig",array(
			'form' => $form->createView(),
		));
	}
	
	public function supprimerAction(Cgv $c){
		$em = $this->getDoctrine()->getManager();
		$em->remove($c);
		$em->flush();
		return $this->redirect($this->generateUrl("Liste_cgv"));
	}
	
	
	public function modifierAction(Cgv $c, Request $request){
		
		$form = $this->createForm(new CgvType(), $c);
		$form->handleRequest($request);
		if($form->isValid()){
			$cgv = $form->getData();
			$em = $this->getDoctrine()->getManager();
			$em->persist($cgv);
			$em->flush();
			return $this->redirect($this->generateUrl("Liste_cgv"));
		}
		return $this->render("ProjetAdminBundle:Cgv:modifier.html.twig",array(
			'form' => $form->createView(),
			'id' => $c->getId(),
		));
	}
	
	
	
}
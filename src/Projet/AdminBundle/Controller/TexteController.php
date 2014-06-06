<?php

namespace Projet\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\DBAL\DBALException;
use Projet\AdminBundle\Entity\Texte;
use Projet\AdminBundle\Form\TexteType;
use Symfony\Component\HttpFoundation\Request;

class TexteController extends Controller{
	public function modifierAction($texte,Request $request){
		
		
		
		
		$em = $this->getDoctrine()->getManager()->getRepository("ProjetAdminBundle:Texte");
		$entite = $em->findOneByPage($texte);
		if($entite){
			$form = $this->createForm(new TexteType(),$entite);
			
			$form->handleRequest($request);
			if($form->isValid()){
				$txt = $form->getData();
				$txt->setPage($texte);
				$em = $this->getDoctrine()->getManager();
				$em->persist($txt);
				$em->flush();
			}
			return $this->render("ProjetAdminBundle:Texte:Modifier.html.twig",array(
				'texte' => $entite,
				'form'	=>$form->createView(),
			));
		}else{
			throw new DBALException("Erreur, l'entite est introuvable !", "404", null);
		}
	}
}
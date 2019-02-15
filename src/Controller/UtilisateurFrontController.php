<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UtilisateurFrontController extends AbstractController
{
    /**
     * @Route("/inscription");
     */
    public function inscription(\Symfony\Component\HttpFoundation\Request $req){
        
        $dto = new \App\DTO\InscriptionDTO();
        $form = $this->createForm(\App\Form\InscriptionType::class,$dto);
        $form->handleRequest($req);
        if($form->isSubmitted() && $form->isValid()){
            $util = new \App\Entity\Utilisateur();
            $util->setNom($dto->getNom())->setMdp($dto->getMdp1());
        $em = $this->getDoctrine()->getManager();
        $em->persist($util);
        $em->flush();
        return $this->redirectToRoute("recette_front");
            
        }
        return $this->render("utilisateur_front/inscription.html.twig",["monForm"=>$form->createView()]);
    }
}

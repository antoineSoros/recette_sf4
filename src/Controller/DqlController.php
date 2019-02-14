<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DqlController extends AbstractController
{
   
    
    /**
     * liste toute les recettes
     * @Route("/req1")
     */
    public function req1()
    {
       $em = $this->getDoctrine()->getManager();
       $em->createQuery("SELECT r FROM App:Recette r")->getResult();
      
    }
    /**
     * lister recette de maite
     * @Route("/req2")
     */
    public function req2() {
        $em = $this->getDoctrine()->getManager();
$em->createQuery("SELECT r FROM App:Recette r JOIN r.utilisateur u WHERE u.nom = 'maite'  ")->getResult();
   
    }
    /**
     * recette de maite contenant de l'anguille
     * @Route("/req3")
     */
     public function req3(){
          $em = $this->getDoctrine()->getManager();
          $em->createQuery("SELECT r FROM App:Recette r  JOIN r.utilisateur u "
                  . "JOIN r.ingredients i "
                  . "WHERE u.nom = 'maite' AND i.nom='anguille'")->getResult();
         
     }
     /**
      * utilisateur qui utilise du sucre
      * @Route("/req4")
      */
     public function req4() {
          $em = $this->getDoctrine()->getManager();
          $em->createQuery("SELECT u "
                  . "FROM App:Utilisateur u "
                  . "JOIN u.recettes r "
                  . "JOIN r.ingredients i "
                  . "WHERE i.nom ='sucre'")->getResult();
         
     }
     /**
      * les ingredients employé par maite
      * @Route("/req5")
      */
     function req5() {
         $em = $this->getDoctrine()->getManager();
          $em->createQuery("SELECT i "
                  . "FROM App:Ingredient i "
                  . "JOIN i.recettes r "
                  . "JOIN r.utilisateur u "
                  . "WHERE u.nom='maite' ORDER BY i.nom")->getResult();
         
         
     }
     /**
      * les recettes avec du chocolat ou de la fraise
      * @Route("/req6")
      */
     function req6() {
         $em = $this->getDoctrine()->getManager();
          $em->createQuery("SELECT r "
                  . "FROM App:Recette r "
                  . "JOIN r.ingredients i "
                  . "WHERE i.nom ='chocolat' OR i.nom='fraise' ORDER BY r.titre")->getResult();
         
         
     }
     /**
      * les recettes avec du chocolat ou de la fraise de michalak
      * @Route("/req7")
      */
     function req7() {
         $em = $this->getDoctrine()->getManager();
          $em->createQuery("SELECT r "
                  . "FROM App:Recette r "
                  . "JOIN r.ingredients i "
                  . "JOIN r.utilisateur u "
                  . "WHERE (i.nom ='chocolat' OR i.nom='fraise') AND u.nom='michalak'")->getResult();
         
         
     }
     /**
      * Les ing utilisés dans des recettes
      * @Route("/req8")
      */
     function req8() {
          $em = $this->getDoctrine()->getManager();  
           $em->createQuery("SELECT DISTINCT  i FROM App:Ingredient i "
                   . "JOIN i.recettes r ")->getResult();
         
     }
     /**
      * les ingredients non utilisés
      * @Route("/req9")
      */
     function req9() {
        $em = $this->getDoctrine()->getManager();
          $em->createQuery("SELECT i FROM App:Ingredient i "
                  . "WHERE i.recettes IS EMPTY ")->getResult();
     }
     /**
      * les ingredients utlisés dans le fondant mais pas dans la mousse au choc
      * @Route("/req10")
      */
     function req10() {
         
     $em = $this->getDoctrine()->getManager();
     $em->createQuery("SELECT i FROM App:Ingredient i "
             . "JOIN i.recettes r "
             . "WHERE r.titre='fondant chocolat' "
             . "AND i NOT IN ("
             . "SELECT i2 "
             . "FROM App:Ingredient i2 "
             . "JOIN i2.recettes r2 "
             . "WHERE r2.titre='mousse au chocolat')")->getResult();
     
     }
     /**
      * le nombre d'ingredients utilisés dans chaque recette (nom Recette +nbre ingred)(triés par nombre d'ingred)
      * @Route("/req11")
      */
    function req11() {
   $em = $this->getDoctrine()->getManager();
    $em->createQuery("SELECT r, count(DISTINCT i) FROM App:Recette r  "
             . "JOIN r.ingredients i GROUP BY r ")->getResult();

    }
    /**
     * idem 11 mais pour les recettes avec plus de trois ingredients
     * @Route("/req12")
     */
    function req12() {
           $em = $this->getDoctrine()->getManager();
            $em->createQuery("SELECT r, count(DISTINCT i) FROM App:Recette r  "
             . "JOIN r.ingredients i GROUP BY r HAVING count(i)>3")->getResult();
    }



         
    
     
}

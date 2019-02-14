<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\IngredientRepository;

class IngredientFrontController extends AbstractController
{
    /**
     * @Route("ingredient-liste", name="ingredient_front")
     */
    public function listerIngredient(\App\Repository\IngredientRepository $rep)
    {
        $ingredients = $rep->findBy([], ['nom'=>'ASC']);
        return $this->render('ingredient_front/liste_ingredient.html.twig', [
            "mesIngredients"=>$ingredients
        ]);
    }
    
    /**
     * 
     *@Route("ingredient-focus/{id}", name="ingredient-focus") 
     */
    public function focusIngredient($id, \App\Repository\IngredientRepository $rep){
        
        $ingredient = $rep->find($id);
        
        return $this->render('ingredient_front/detail.html.twig',['ingredient'=>$ingredient ]);
    }
    
    /**
     * @Route("supp-ingredient/{id}", name="sup-ingredient")
     */
    public function deleteIngredient(\App\Entity\Ingredient $ingredient){
       
        $em = $this->getDoctrine()->getManager();
        $em->remove($ingredient);
        $em->flush();
        return $this->redirectToRoute("ingredient_front");
        
    }
    
    
}

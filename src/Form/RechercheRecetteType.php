<?php

namespace App\Form;

use App\DTO\RechercheRecetteDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercheRecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add('auteur', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class,['required'=>false,
                    'class'=> \App\Entity\Utilisateur::class,
                     'query_builder' => function (\App\Repository\UtilisateurRepository $qb) {
        return $qb->createQueryBuilder('u')->join('u.recettes', 'r')                
            ->orderBy('u.nom', 'ASC');
    },
            ])
        
                ->add('recette',null,['required'=>false])
                ->add('ingredient', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class,['required'=>false,
                     'class'=> \App\Entity\Ingredient::class,
                    'query_builder' => function (\App\Repository\IngredientRepository $qb) {
        return $qb->createQueryBuilder('i')->join('i.recettes', 'r')                
            ->orderBy('i.nom', 'ASC');
    },])
                ->add('SEARCH', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => RechercheRecetteDTO::class,
        ]);
    }
}

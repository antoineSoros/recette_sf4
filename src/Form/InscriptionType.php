<?php

namespace App\Form;

use App\DTO\InscriptionDTO;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', \Symfony\Component\Form\Extension\Core\Type\TextType::class,['label'=>'PSEUDO','required'=>false])
            ->add('mdp1', \Symfony\Component\Form\Extension\Core\Type\PasswordType::class,['label'=>' password'])
            ->add('mdp2',\Symfony\Component\Form\Extension\Core\Type\PasswordType::class,['label'=>'confirm password'])
            ->add('SUBMIT', \Symfony\Component\Form\Extension\Core\Type\SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => InscriptionDTO::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Categorie;
use App\Entity\Compte;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('categorie', EntityType::class, [
                'class' =>Categorie::class,
                'choice_label' => 'titre'
            ])
            ->add('nomCompte')
            ->add('urlCompte')
            ->add('loginCompte')
            ->add('passwordCompte')
            ->add('descriptionCompte')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Compte::class,
        ]);
    }
}

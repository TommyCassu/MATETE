<?php

namespace App\Form;

use App\Entity\Annonce;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnonceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('creneauxDebut')
            ->add('creneauxFin')
            ->add('libelleProduit')
            ->add('prixUnitaire')
            ->add('quantite')
            ->add('lieu')
            ->add('categorie')
            ->add('producteur')
            ->add('dateMiseEnLigne')
            ->add('status')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Annonce::class,
        ]);
    }
}

<?php

namespace App\Form;

use App\Entity\Cdc;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CdcType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('fonction')
            ->add('objectif')
            ->add('description')
            ->add('contrainte')
            ->add('priority')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Cdc::class,
            'translation_domain' => 'forms_Cdc'
        ]);
    }
}

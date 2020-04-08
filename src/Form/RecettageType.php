<?php

namespace App\Form;

use App\Entity\Recettage;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RecettageType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('navigator')
            ->add('status')
            ->add('ask')
            ->add('bug')
            ->add('ask_fonctionality')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Recettage::class,
            'translation_domain' => 'forms_Recettage'
        ]);
    }
}

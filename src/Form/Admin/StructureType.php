<?php

namespace App\Form\Admin;

use App\Entity\Admin\Structure;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add('respFirstName')
            ->add('respLastName')
            ->add('address')
            ->add('complement')
            ->add('zipcode')
            ->add('city')
            ->add('siret')
            ->add('ape')
            ->add('tvaNumber')
            ->add('urlWeb')
            ->add('urlFacebook')
            ->add('urlInstagram')
            ->add('urlLinkedin')
            ->add('EmailStruct')
            ->add('phoneDesk')
            ->add('phoneGsm')
            ->add('FirstActivity')
            ->add('secondActivity')
            ->add('projectDev')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Structure::class,
        ]);
    }
}

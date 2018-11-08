<?php
// src/AppBundle/Form/RegistrationType.php

namespace IntakeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('voornaam')
            ->add('achternaam')
            ->add('woonplaats')
            ->add('huisnummer')
            ->add('postcode')
            ->add('telefoonnummer');
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getVoornaam()
    {
        return $this->getBlockPrefix();
    }
}
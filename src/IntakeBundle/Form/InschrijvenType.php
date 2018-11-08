<?php

namespace IntakeBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class InschrijvenType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('locatieId', null, array('label' => 'Locatie:'))
            ->add('opleidingId', null, array('label' => 'Opleiding keuze'))
            ->add('beschikbaarheidId', null, array('label' => 'Voorkeur data gesprek')
            );

    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'IntakeBundle\Entity\Afspraak'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'intakebundle_afspraak';
    }


}

<?php

namespace App\Form;

use App\Entity\EtapeCircuit;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EtapeCircuitType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('duree_etape')
            ->add('ordre_etape')
            ->add('code_ville_etape')
            ->add('code_circuit_etape')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => EtapeCircuit::class,
        ]);
    }
}

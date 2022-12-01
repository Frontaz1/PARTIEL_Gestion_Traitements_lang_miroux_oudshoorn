<?php

namespace App\Form;

use App\Entity\Indication;
use App\Entity\Medicament;
use App\Entity\Traitement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class IndicationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('traitement',
        EntityType::class, 
        array('class'=>Traitement::class, 
        'choice_label'=>'id', 
        'label'=>'Traitement : '
        , 'label_format'=>'DD MM YYYY'
        ))
        ->add('medicament', EntityType::class, array('class'=>Medicament::class, 'choice_label'=>'libelle', 'label'=>'Medicament : '))
        ->add('posologie', TextType::class, array('label'=>'Posologie : '))
        ->add('save', SubmitType::class, array('label'=>'Enregistrer l\'indication'));  
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Indication::class,
        ]);
    }
}

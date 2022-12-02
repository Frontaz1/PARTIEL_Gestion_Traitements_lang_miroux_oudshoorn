<?php

namespace App\Form;

use App\Entity\EffetSnd;
use App\Entity\Medicament;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EffetSndType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description', TextType::class, array('label'=>'Description : '))
            ->add('medicaments', EntityType::class, array('class' => Medicament::class,
                                                            'label' => 'Médicament(s) concerné(s)',
                                                            'choice_label' => 'libelle',
                                                            'multiple' => true,))
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => EffetSnd::class,
        ]);
    }
}

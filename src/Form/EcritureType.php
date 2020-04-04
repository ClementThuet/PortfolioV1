<?php

namespace App\Form;

use App\Entity\Categorie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class EcritureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Nom', TextType::class, array('label'  => 'Nom : '))
            ->add('date', DateType::class, array('label'  => 'Date : ', 'widget' => 'single_text',
                'format' => 'yyyy-MM-dd','required' => true))
            ->add('montant', NumberType::class, array('label'  => 'Montant : ','required' => true))
            ->add('description', TextType::class, array('label'  => 'Description : ','required' => false))
            ->add('categorie', EntityType::class, array(
                    'class'        => Categorie::class,
                    'choice_label' => 'nom'))
            ->add('sensflux', CheckboxType::class, array('label'  => 'Crédit ?  : ', 'attr' => array('style' => 'zoom:2.5;'),'required' => false))    
            ->add('partageable', CheckboxType::class, array('label'  => 'partageable  : ', 'attr' => array('style' => 'zoom:2.5;'),'required' => false))
            ->add('imposable', CheckboxType::class, array('label'  => 'imposable  : ', 'attr' => array('style' => 'zoom:2.5;'),'required' => false))
            ->add('Enregistrer',      SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // uncomment if you want to bind to a class
            //'data_class' => Ecriture::class,
        ]);
    }
}

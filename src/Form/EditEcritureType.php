<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class EditEcritureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       
    }
    public function getParent()
    {
        return EcritureType::class;
    }
}

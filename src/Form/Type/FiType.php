<?php
namespace App\Form\Type;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FiType
 *
 * @author mtmat
 */
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Type;

class FiType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('types', EntityType::class, [
        'class' => Type::class,
        'choice_label' => 'nom',
        ])
                ->add('save', SubmitType::class, ['label' => 'Filtrer']);
    }
}
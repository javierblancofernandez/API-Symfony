<?php

namespace AppBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class TapaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        -> add('nombre',TextType::class)
        -> add('descripcion',CKEditorType::class)
        -> add('ingredientes',EntityType::class, ['class' => 'AppBundle:Ingrediente','multiple' => true])
        -> add('categoria', EntityType::class, ['class' => 'AppBundle:Categoria'])
        -> add('foto',FileType::class,['attr'=>['onchange'=>'onChange(event)']])
        -> add('top')
        -> add('save', SubmitType::class, ['label' => 'Nueva Tapa'])
        ;
    } 
}
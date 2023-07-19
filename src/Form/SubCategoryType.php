<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\SubCategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SubCategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('title_fr',TextType::class,[
            'required' => true,
            'label' => false,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Entrez un titre',
            ]
        ])
        ->add('title_de',TextType::class,[
            'required' => true,
            'label' => false,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Entrez un titre',
            ]
        ])
        ->add('title_it',TextType::class,[
            'required' => true,
            'label' => false,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Entrez un titre',
            ]
        ])
        ->add('description_fr',TextareaType::class,[
            'required' => true,
            'label' => false,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Entrez une description',
            ]
        ])
        ->add('description_de',TextareaType::class,[
            'required' => true,
            'label' => false,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Entrez une description',
            ]
        ])
        ->add('description_it',TextareaType::class,[
            'required' => true,
            'label' => false,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Entrez une description',
            ]
        ])
        ->add('ranking',IntegerType::class,[
            'required' => true,
            'label' => false,
            'attr' => [
                'class' => 'form-control',
                'placeholder' => 'Entrez un rang',
            ]
        ])
        ->add('is_visible', ChoiceType::class,[
            'required' => true,
            'label' => false,
            'choices' => [
                'Publier' => true,
                'Masquer' => false
            ],
            'attr' => [
                'class' => 'form-control',
                'value' => true
            ],
            'expanded'=>true
        ])
        ->add('category', EntityType::class,[
            'class' => Category::class,
            'required' => true,
            'label' => false,
            'choice_label' => 'title_fr',
            'attr' => [
                'class' => 'form-control'
            ],
            'placeholder' => 'Sélectionnez une catégorie',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SubCategory::class,
        ]);
    }
}

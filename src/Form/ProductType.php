<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title_fr')
            ->add('title_de')
            ->add('title_it')
            ->add('short_description_fr')
            ->add('short_description_de')
            ->add('short_description_it')
            ->add('description_fr')
            ->add('description_de')
            ->add('description_it')
            ->add('is_visible')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('price')
            ->add('sale_price')
            ->add('is_sale_price')
            ->add('condition_value')
            ->add('availability')
            ->add('category')
            ->add('sub_category')
            ->add('user')
            ->add('edit_user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

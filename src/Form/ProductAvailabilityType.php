<?php

namespace App\Form;

use App\Entity\ProductAvailability;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductAvailabilityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title_fr')
            ->add('title_de')
            ->add('title_it')
            ->add('is_available')
            ->add('created_at')
            ->add('updated_at')
            ->add('user')
            ->add('edit_user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductAvailability::class,
        ]);
    }
}

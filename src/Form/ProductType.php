<?php

namespace App\Form;

use App\Entity\Products;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ColorType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('location',TextType::class,['label' => 'Location'])
            ->add('type', TextType::class,['label' => 'Type'])
            ->add('device_health',TextType::class,['label' => 'Device health'])
           // ->add('last_used')
            ->add('price',TextType::class,['label' => 'Price'])
            ->add('color',ColorType::class,['label' => 'Color'])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}

<?php

namespace LinkerBundle\Form;

use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LinkType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('url', UrlType::class, [
                'attr' => [
                    'class' => 'form-control input-sm',
                    'placeholder' => "Copy the URL you want to shorten"
                ]
            ])
            ->add('shortUrlId', null,[
                'required'   => false,
                'empty_data' => uniqid('id_'),
                'attr' => [
                        'class' => 'form-control input-sm',
                        'placeholder' => "Insert string ID you would like to see in the short link"
                    ]
                ]
            )

        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'LinkerBundle\Entity\Link',
            'attr' => [
                'class' => 'form-horizontal'
            ]
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'linkerbundle_link';
    }


}

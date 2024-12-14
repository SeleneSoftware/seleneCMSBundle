<?php

namespace Selene\CMSBundle\Form;

use Selene\CMSBundle\Entity\Blog;
use Selene\CMSBundle\Entity\ImageFile;
use Selene\CMSBundle\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BlogType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('slug')
            ->add('preview')
            ->add('DatePublished', null, [
                'widget' => 'single_text',
            ])
            ->add('date_created', null, [
                'widget' => 'single_text',
            ])
            ->add('date_updated', null, [
                'widget' => 'single_text',
            ])
            ->add('author', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            ->add('imageFile', EntityType::class, [
                'class' => ImageFile::class,
                'choice_label' => 'id',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Blog::class,
        ]);
    }
}

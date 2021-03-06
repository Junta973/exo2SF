<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Tags;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('content')
            ->add('createdAt',DateType::class,[
                //mets la date sur une ligne avec le calendrier
                'widget'=>'single_text',

                //renseigne automatiquement la date d'enregistrement
                'data'=> new\DateTime('NOW'),
            ])
            ->add('Ispublished', CheckboxType::class,[
                'label'=> null,
                'data'=> true,
            ])

            ->add('category',EntityType::class,[
                'class'=> Category::class,
                'choice_label'=>'title'
            ])

            ->add('tag',EntityType::class,[
                'class'=> Tags::class,
                'choice_label'=>'title'
            ])

            ->add('submit',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

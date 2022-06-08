<?php

namespace App\Form;

use App\Entity\Article;
use App\Entity\User;
use Doctrine\DBAL\Types\FloatType;
use Doctrine\ORM\Mapping\Entity;
use phpDocumentor\Reflection\Types\Float_;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        // Ici l'ajout du type avec ::class permet d'avoir acces aux attrbuts et methodes de la classe.
            ->add('name', TextType::class, ["label" => "Nom"])
            ->add('description', TextareaType::class, ["label" => "Description"])
            ->add('price', NumberType::class, ["label" => "Prix"])
            ->add('owner', EntityType::class, 
            ['class'=>User::class, 
            'choice_label'=>'prenom'])
            // ->add('Ajouter', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

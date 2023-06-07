<?php
namespace App\Form\Type;

use App\Entity\GuestbookEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuestbookType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options){

        $builder->add('username', TextType::class, ['empty_data' => '']); // kein NULL es wird ein leerer String übergeben...
        $builder->add('email', EmailType::class, ['required' => false]); // Pflichtfeld
        $builder->add('subtitle', TextType::class, ['empty_data' => '']);
        $builder->add('body', TextType::class, ['empty_data' => '']);
        $builder->add('submit', SubmitType::class);
    }

    // Erstellung von Objekten für die Speicherung in einer DB
    public function configureOptions(OptionsResolver $resolver)
    {
       $resolver->setDefaults([
            'data_class' => GuestbookEntity::class,
            'csrf_protection' => true,
       ]); 
    }
}
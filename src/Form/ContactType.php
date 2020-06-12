<?php

namespace App\Form;

use App\Entity\Contact;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        $builder
            -> add( 'email', EmailType::class,[
              'attr' => [
                'placeholder' => 'adresse email',
                'class' => 'form-control'
              ],
              'label' => false
            ] )
            -> add( 'message', TextareaType::class,[
              'attr' => [
                'rows' => '5',
                'margin' => '3px',
                'placeholder' => 'écrivez votre message ',
                'class' => 'form-control'
              ],
              'label' => false
            ] );
    }

    public function configureOptions( OptionsResolver $resolver )
    {
        $resolver -> setDefaults( [
            'data_class' => Contact::class,
        ] );
    }
}

<?php

namespace App\Form;

use App\Entity\Booking;
use App\Entity\Customer;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('startDate', DateType::class, ['widget'=> 'single_text'])
            ->add('endDate',DateType::class, ['widget'=> 'single_text'])
            ->add('comment', TextareaType::class, ['required'=>false])
            ->add('customer', EntityType::class, [
                'class' => Customer::class,
                // 'multiple' => true,
                // 'expanded' => true,
/*                'choice_label' => 'lastname',
                'choice_value' => 'id',*/
            ])
            ->add('room', EntityType::class, [
                'class' => Room::class,
                // 'multiple' => true,
                // 'expanded' => true,
                'choice_label' => 'number',
                'choice_value' => 'id',
            ])
            ->add('save', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Booking::class,
        ]);
    }
}

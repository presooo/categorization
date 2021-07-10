<?php


namespace App\Presentation\Form;


class CategoriseItem
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', HiddenType::class, [
                'empty_data' => $options['id'] ?? $options['id']
            ])
            ->add('title', TextType::class, [
                'attr' => ['maxlength' => 191],
            ])
            ->add('target', TextType::class, [
                'attr' => ['maxlength' => 191],
            ])
            ->add('date_created', DateTimeType::class, []);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);

        $resolver->setDefaults([
            'data_class'  => \App\Application\Command\Items\CategoriseItem::class
        ]);
    }
}

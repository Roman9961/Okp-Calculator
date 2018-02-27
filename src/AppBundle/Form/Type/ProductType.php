<?php


namespace AppBundle\Form\Type;


use CoreBundle\Entity\Paper;
use CoreBundle\Entity\Printing;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('printings', EntityType::class,[
                'label'=>'Print',
                'class' => Printing::class,
                'choice_label' => 'name',
            ])
            ->add('papers', EntityType::class,[
                'label'=>'Paper',
                'class' => Paper::class,
                'choice_label' => function ($printing) {
                    return $printing->getName() . ' ' . $printing->getDensity();
                }
            ])
            ->add('count', NumberType::class,['data' => 10]);
    }

//    public function configureOptions(OptionsResolver $resolver)
//    {
//        parent::configureOptions($resolver);
//
//        $resolver->setDefaults([
//            'data_class' => AudiobookChapter::class,
//        ]);
//    }
}

<?php

namespace App\Admin;

use App\Entity\Ticket;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\ChoiceFieldMaskType;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Vich\UploaderBundle\Form\Type\VichImageType;

final class EventAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form): void
    {
        $form->add('name',);
        $form->add('description');
        $form->add('address',);
        $form->add('startdate');
        $form->add('enddate',);
        $form->add('imageFile', VichImageType::class);
        $form->add('ticket', EntityType::class, $this->getOptions());
    }

    protected function configureDatagridFilters(DatagridMapper $datagrid): void
    {
        $datagrid->add('name',);
        $datagrid->add('description');
        $datagrid->add('address',);
        $datagrid->add('startdate',);
        $datagrid->add('enddate',);
        $datagrid->add('ticket',);
    }

    protected function configureListFields(ListMapper $list): void
    {
        $list->addIdentifier('id');
        $list->add('name',);
        $list->add('description');
        $list->add('address',);
        $list->add('startdate',);
        $list->add('enddate',);
        $list->add('ticket',);
    }

    protected function configureShowFields(ShowMapper $show): void
    {
        $show->add('name',);
        $show->add('description');
        $show->add('address',);
        $show->add('startdate',);
        $show->add('enddate',);
        $show->add('ticket');
        $show->add('imageFile', null, [
            'base_path' => 'public/uploads/media/',
            'label' => 'Image'
        ]);
    }

    private function getOptions()
    {
        return [
            'class' => Ticket::class,
            'choice_label' => function ($ticket) {
                return $ticket->getName() . ' (' . 'Rs. ' . $ticket->getPrice() . ')';
            }
        ];
    }
}

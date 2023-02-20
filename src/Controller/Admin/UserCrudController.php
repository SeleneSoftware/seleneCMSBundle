<?php

namespace Selene\CMSBlog\Controller\Admin;

use Selene\CMSBlog\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // yield Field\IdField::new('id');
        yield Field\TextField::new('email');
        yield Field\TextField::new('name');
        yield Field\ChoiceField::new('roles')
            ->setChoices([
                'Standard User Role' => 'ROLE_USER',
                'Employee Role' => 'ROLE_EMP',
                'Admin Role' => 'ROLE_ADMIN',
            ])
            ->allowMultipleChoices()
        ;
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
        ;
    }
}

<?php

namespace Selene\CMSBundle\Controller\Admin;

use Selene\CMSBundle\Entity\Settings;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SettingsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Settings::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name'),
            BooleanField::new('value'),
        ];
    }
}

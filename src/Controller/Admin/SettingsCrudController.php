<?php

namespace Selene\CMSBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Selene\CMSBundle\Entity\Settings;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SettingsCrudController extends AbstractController
{
    // public static function getEntityFqcn(): string
    // {
    //     return Settings::class;
    // }
    //
    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         TextField::new('name'),
    //         BooleanField::new('value'),
    //     ];
    // }
}

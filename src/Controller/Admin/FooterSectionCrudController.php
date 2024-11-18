<?php

namespace Selene\CMSBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Selene\CMSBundle\Entity\FooterSection;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FooterSectionCrudController extends AbstractController
{
    // public static function getEntityFqcn(): string
    // {
    //     return FooterSection::class;
    // }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}

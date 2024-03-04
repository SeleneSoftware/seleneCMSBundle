<?php

namespace Selene\CMSBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Selene\CMSBundle\Entity\Footer;
use Selene\CMSBundle\Entity\FooterSection;

class FooterCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Footer::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextField::new('route'),
            AssociationField::new('footerSection'),
            // ChoiceField::new('section')->setChoices(
            //     static fn (?FooterSection $foo): array => $foo->getName()->getChoices() ?: []
            // )->autocomplete(),

        ];
    }
}

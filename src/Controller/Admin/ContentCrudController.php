<?php

namespace Selene\Controller\Admin;

use Selene\Entity\Content;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field;

class ContentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Content::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            // Field\IdFielddd::new('id'),
            Field\TextField::new('name'),
            Field\TextareaField::new('value'),
            Field\DateTimeField::new('date_updated')
                ->setDisabled(),
            // ->setValue(new \DateTime('today')),
        ];
    }
}

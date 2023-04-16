<?php

namespace Selene\CMSBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field;
use Selene\CMSBundle\Entity\Blog;

class BlogCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Blog::class;
    }

    public function configureFields(string $pageName): iterable
    {
        if (in_array('ROLE_ADMIN', $this->getUser()->getRoles(), true)) {
            yield Field\AssociationField::new('author');
        }
        yield Field\TextField::new('title');
        yield Field\SlugField::new('slug')->setTargetFieldName('title');
        yield Field\TextareaField::new('preview');
        yield Field\AssociationField::new('imageFile'); // ->autocomplete();
        yield Field\TextareaField::new('content'); // Only because Trix isn't working properly
        yield Field\DateTimeField::new('date_published');
        yield Field\DateTimeField::new('date_updated')
            ->setDisabled();
    }

    public function createEntity(string $entityFqcn)
    {
        $entity = new Blog();
        $entity->setAuthor($this->getUser());

        return $entity;
    }
}

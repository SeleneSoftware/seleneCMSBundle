<?php

namespace Selene\CMSBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field;
use Selene\CMSBundle\Entity\Comment;

class CommentCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Comment::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield Field\TextField::new('title');
        yield Field\TextareaField::new('content');
        yield Field\BooleanField::new('public');
        yield Field\TextField::new('blog')->setFormTypeOption('disabled', 'disabled');
        yield Field\TextField::new('author')->setFormTypeOption('disabled', 'disabled');
    }
}

<?php

namespace App\Controller\Admin;

use App\Entity\Blog;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field;

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
        yield Field\ImageField::new('imageFile')
            ->setUploadedFileNamePattern('/uploads/images/[name].[extension]')
            ->setUploadDir('public/uploads/images/');
        yield Field\TextareaField::new('content'); // Only because Trix isn't working properly
        yield Field\DateTimeField::new('date_published');
        yield Field\DateTimeField::new('date_updated')
            ->setDisabled();
        // Field\TextEditorField::new('content')->setTrixEditorConfig([
        //     'blockAttributes' => [
        //         'default' => ['tagName' => 'p'],
        //         'heading1' => ['tagName' => 'h2'],
        //     ],
        //     'css' => [
        //         'attachment' => 'admin_file_field_attachment',
        //     ],
        // ]),
    }

    public function createEntity(string $entityFqcn)
    {
        $entity = new Blog();
        $entity->setAuthor($this->getUser());

        return $entity;
    }
}

<?php

namespace Selene\CMSBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field;
use Selene\CMSBundle\Entity\ImageFile;

class ImageFileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageFile::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // if (in_array('ROLE_ADMIN', $this->getUser()->getRoles(), true)) {
        //     yield Field\AssociationField::new('author');
        // }
        yield Field\TextField::new('name');
        yield Field\SlugField::new('slug')->setTargetFieldName('name');
        yield Field\ImageField::new('imageFile')
            ->setUploadedFileNamePattern('/uploads/images/[name].[extension]')
            ->setUploadDir('public/uploads/images/');
        yield Field\TextareaField::new('description');
    }
}

<?php

namespace Selene\CMSBundle\Controller\Admin;

use Selene\CMSBundle\Entity\ImageFile;
use EasyCorp\Bundle\EasyAdminBundle\Field;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

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
        yield Field\ImageField::new('file')
            ->setUploadedFileNamePattern('/uploads/images/[name].[extension]')
            ->setUploadDir('public/uploads/images/');
        yield Field\TextareaField::new('description');
    }
}

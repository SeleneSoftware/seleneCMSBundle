<?php

namespace Selene\CMSBundle\Controller\Admin;

use Selene\CMSBundle\Entity\ImageFile;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ImageFileCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageFile::class;
    }


    // public function configureFields(string $pageName): iterable
    // {
    //     return [
    //         ImageField::new('file'),
    //     ];
    // }
}

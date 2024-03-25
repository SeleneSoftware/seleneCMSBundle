<?php

namespace Selene\CMSBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'selene_cms_profile')]
    public function profileList(EntityManagerInterface $doctrine): Response
    {
        return $this->render('profile/index.html.twig', [
        ]);
    }
}

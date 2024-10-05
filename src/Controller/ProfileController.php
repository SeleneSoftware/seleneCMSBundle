<?php

namespace Selene\CMSBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'selene_cms_profile')]
    #[IsGranted('ROLE_USER')]
    public function profile(EntityManagerInterface $doctrine): Response
    {

        return $this->render('profile/index.html.twig', [
        ]);
    }
}

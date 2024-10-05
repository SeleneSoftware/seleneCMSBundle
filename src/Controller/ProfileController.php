<?php

namespace Selene\CMSBundle\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_USER')]
class ProfileController extends AbstractController
{
    #[Route('/profile', name: 'selene_cms_profile')]
    public function profile(EntityManagerInterface $doctrine): Response
    {
        dd($this->getUser());

        return $this->render('profile/index.html.twig', [
        ]);
    }
}

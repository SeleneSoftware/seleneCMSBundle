<?php

namespace Selene\CMSBundle\Controller;

use Selene\CMSBundle\Twig\Filter\ContentFilter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecureController extends AbstractController
{
    #[Route(path: '/login', name: 'selene_cms_login')]
    public function login(AuthenticationUtils $authenticationUtils, ContentFilter $content): Response
    {
        $redirect = $content->getContent('Login Redirect', 'selene_cms_blog');
        if ($this->getUser()) {
            return $this->redirectToRoute($redirect);
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: '/logout', name: 'selene_cms_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}

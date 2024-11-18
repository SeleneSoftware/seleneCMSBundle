<?php

namespace Selene\CMSBundle\Controller\Admin;

use Selene\CMSBundle\Entity\Blog;
use Selene\CMSBundle\Entity\Comment;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use function Symfony\Component\Translation\t;

class DashboardController extends AbstractController
{
    #[Route('/admin', name: 'selene_cms_admin')]
    public function adminIndex(): Response
    {
        return $this->render('@selene_cms_bundle/admin/dashboard.html.twig', [
        ]);
    }

    // public function configureDashboard(): Dashboard
    // {
    //     return Dashboard::new()
    //         ->setTitle('Selene CMS')
    //     ;
    // }
    //
    // public function configureMenuItems(): iterable
    // {
    //     yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
    //
    //     yield MenuItem::linkToCrud('Blogs', 'fas fa-list', Blog::class);
    //     yield MenuItem::linkToCrud('Comments', 'fas fa-list', Comment::class);
    //     yield MenuItem::linkToCrud('Images', 'fas fa-list', ImageFile::class);
    //     yield MenuItem::linkToCrud('Content', 'fas fa-list', Content::class);
    //     yield MenuItem::linkToCrud('Footer', 'fas fa-list', Footer::class);
    //     yield MenuItem::linkToCrud('Footer Section', 'fas fa-list', FooterSection::class);
    //     yield MenuItem::linkToCrud('Settings', 'fas fa-list', Settings::class);
    //
    //     yield MenuItem::linkToCrud('Users', 'fas fa-list', User::class)
    //         ->setPermission('ROLE_ADMIN')
    //     ;
    // }
    //
    // public function configureUserMenu(UserInterface $user): UserMenu
    // {
    //     $userMenuItems = [
    //         MenuItem::linkToRoute('Profile', 'fa fa-home', 'selene_cms_profile'),
    //     ];
    //
    //     if (class_exists(LogoutUrlGenerator::class)) {
    //         $userMenuItems[] = MenuItem::section();
    //         $userMenuItems[] = MenuItem::linkToLogout(t('user.sign_out', domain: 'EasyAdminBundle'), 'fa-sign-out');
    //     }
    //     if ($this->isGranted(Permission::EA_EXIT_IMPERSONATION)) {
    //         $userMenuItems[] = MenuItem::linkToExitImpersonation(t('user.exit_impersonation', domain: 'EasyAdminBundle'), 'fa-user-lock');
    //     }
    //
    //     $userName = method_exists($user, '__toString') ? (string) $user : $user->getUserIdentifier();
    //
    //     return UserMenu::new()
    //         ->displayUserName()
    //         ->displayUserAvatar()
    //         ->setName($userName)
    //         ->setAvatarUrl(null)
    //         ->setMenuItems($userMenuItems);
    // }
}

<?php

namespace Selene\CMSBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Selene\CMSBundle\Entity\Blog;
use Selene\CMSBundle\Entity\Comment;
use Selene\CMSBundle\Entity\Content;
use Selene\CMSBundle\Entity\Footer;
use Selene\CMSBundle\Entity\FooterSection;
use Selene\CMSBundle\Entity\ImageFile;
use Selene\CMSBundle\Entity\Settings;
use Selene\CMSBundle\Entity\User;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'selene_cms_admin')]
    public function adminIndex(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
        return $this->render('admin/dashboard.html.twig', [
        ]);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Selene CMS')
        ;
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Blogs', 'fas fa-list', Blog::class);
        yield MenuItem::linkToCrud('Comments', 'fas fa-list', Comment::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-list', ImageFile::class);
        yield MenuItem::linkToCrud('Content', 'fas fa-list', Content::class);
        yield MenuItem::linkToCrud('Footer', 'fas fa-list', Footer::class);
        yield MenuItem::linkToCrud('Footer Section', 'fas fa-list', FooterSection::class);
        yield MenuItem::linkToCrud('Settings', 'fas fa-list', Settings::class);

        yield MenuItem::linkToCrud('Users', 'fas fa-list', User::class)
            ->setPermission('ROLE_ADMIN')
        ;
    }

    public function configureUserMenu(UserInterface $user): UserMenu
    {
        $userMenuItems = [
            MenuItem::linkToRoute('Profile', 'fa fa-home', 'selene_cms_profile'),
        ];

        if (class_exists(LogoutUrlGenerator::class)) {
            $userMenuItems[] = MenuItem::section();
            $userMenuItems[] = MenuItem::linkToLogout(t('user.sign_out', domain: 'EasyAdminBundle'), 'fa-sign-out');
        }
        if ($this->isGranted(Permission::EA_EXIT_IMPERSONATION)) {
            $userMenuItems[] = MenuItem::linkToExitImpersonation(t('user.exit_impersonation', domain: 'EasyAdminBundle'), 'fa-user-lock');
        }

        $userName = method_exists($user, '__toString') ? (string) $user : $user->getUserIdentifier();

        return UserMenu::new()
            ->displayUserName()
            ->displayUserAvatar()
            ->setName($userName)
            ->setAvatarUrl(null)
            ->setMenuItems($userMenuItems);
    }
}

<?php

namespace Selene\CMSBundle\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\KeyValueStore;
use EasyCorp\Bundle\EasyAdminBundle\Context\AdminContext;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Field;
use Selene\CMSBundle\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserCrudController extends AbstractCrudController
{
    private UserPasswordHasherInterface $passwordEncoder;

    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        // yield Field\IdField::new('id');
        yield Field\TextField::new('email');
        yield Field\TextField::new('name');
        yield Field\ChoiceField::new('roles')
            ->setChoices([
                'Standard User Role' => 'ROLE_USER',
                'Employee Role' => 'ROLE_EMP',
                'Admin Role' => 'ROLE_ADMIN',
            ])
            ->allowMultipleChoices()
        ;

        yield FormField::addPanel('Change password')->setIcon('fa fa-key');
        yield Field::new('password', 'New password')->onlyWhenCreating()->setRequired(true)
                   ->setFormType(RepeatedType::class)
                   ->setFormTypeOptions([
                       'type' => PasswordType::class,
                       'first_options' => ['label' => 'New password'],
                       'second_options' => ['label' => 'Repeat password'],
                       'error_bubbling' => true,
                       'invalid_message' => 'The password fields do not match.',
                   ]);
        yield Field::new('password', 'New password')->onlyWhenUpdating()->setRequired(false)
                   ->setFormType(RepeatedType::class)
                   ->setFormTypeOptions([
                       'type' => PasswordType::class,
                       'first_options' => ['label' => 'New password'],
                       'second_options' => ['label' => 'Repeat password'],
                       'error_bubbling' => true,
                       'invalid_message' => 'The password fields do not match.',
                   ]);
    }

    public function createEditFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $plainPassword = $entityDto->getInstance()?->getPassword();
        $formBuilder = parent::createEditFormBuilder($entityDto, $formOptions, $context);
        $this->addEncodePasswordEventListener($formBuilder, $plainPassword);

        return $formBuilder;
    }

    public function createNewFormBuilder(EntityDto $entityDto, KeyValueStore $formOptions, AdminContext $context): FormBuilderInterface
    {
        $formBuilder = parent::createNewFormBuilder($entityDto, $formOptions, $context);
        $this->addEncodePasswordEventListener($formBuilder);

        return $formBuilder;
    }

    protected function addEncodePasswordEventListener(FormBuilderInterface $formBuilder, $plainPassword = null): void
    {
        $formBuilder->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) use ($plainPassword) {
            /** @var User $user */
            $user = $event->getData();
            if ($user->getPassword() !== $plainPassword) {
                $user->setPassword($this->passwordEncoder->hashPassword($user, $user->getPassword()));
            }
        });
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
            ->remove(Crud::PAGE_INDEX, Action::NEW)
        ;
    }
}

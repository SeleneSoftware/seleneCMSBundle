<?php

namespace Selene\Handlers;

use Selene\Entity\Settings;
use Doctrine\Persistence\ManagerRegistry;

class SettingsHandler
{
    protected $doctrine;

    public function __construct(ManagerRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function getSetting(string $name): bool
    {
        $setting = $this->doctrine->getRepository(Settings::class)->findOneByName($name);

        if (null === $setting) {
            $em = $this->doctrine->getManager();
            $setting = new Settings();
            $setting->setName($name)->setValue(false);

            $em->persist($setting);
            $em->flush();
        }

        return $setting->getValue();
    }
}

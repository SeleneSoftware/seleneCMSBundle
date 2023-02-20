<?php

namespace Selene\EventSubscriber;

use Selene\Interfaces\DatedEntityInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class EasyAdminSubscriber implements EventSubscriberInterface
{
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityUpdatedEvent::class => ['setDateUpdated'],
        ];
    }

    // I got this all ready, and now I don't need it.  But it's here in case I do again.
    // Against my better judgement.
    // public function setValueBool(BeforeEntityUpdatedEvent $event)
    // {
    // }

    public function setDateUpdated(BeforeEntityUpdatedEvent $event)
    {
        $entity = $event->getEntityInstance();

        if (!($entity instanceof DatedEntityInterface)) {
            return;
        }

        $entity->setDateUpdated(new \DateTime());
    }
}

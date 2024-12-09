<?php

namespace Selene\CMSBundle\Sidebar;

class SidebarTransportChain
{
    private array $transports = [];

    public function addTransport(\MailerTransport $transport): void
    {
        $this->transports[] = $transport;
    }
}

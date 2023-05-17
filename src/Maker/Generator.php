<?php

namespace Selene\CMSBundle\Maker;

use Symfony\Bundle\MakerBundle\Generator as SymGen;

class Generator extends SymGen
{
    private function addOperation(string $targetPath, string $templateName, array $variables): void
    {
        if ($this->fileManager->fileExists($targetPath)) {
            throw new RuntimeCommandException(sprintf('The file "%s" can\'t be generated because it already exists.', $this->fileManager->relativizePath($targetPath)));
        }

        $variables['relative_path'] = $this->fileManager->relativizePath($targetPath);

        $templatePath = $templateName;
        if (!file_exists($templatePath)) {
            $templatePath = __DIR__.'/../Resources/skeleton/'.$templateName;

            if (!file_exists($templatePath)) {
                throw new \Exception(sprintf('Cannot find template "%s"', $templateName));
            }
        }

        $this->pendingOperations[$targetPath] = [
            'template' => $templatePath,
            'variables' => $variables,

        ];
    }
}

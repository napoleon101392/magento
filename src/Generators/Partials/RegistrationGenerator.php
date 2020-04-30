<?php

namespace Napoleon\Magento\Generators\Partials;

use Napoleon\Magento\Generators\Generator;
use Napoleon\Magento\Generators\GeneratorInterface;
use Napoleon\Support\Transformer\Transformer;

class RegistrationGenerator extends Generator implements GeneratorInterface
{
    public function publish()
    {
        $arguments = [
            '{VENDOR}' => $this->getVendor(),
            '{MODULE}' => $this->getModule()
        ];

        return (new Transformer())
            ->stub($this->stub())
            ->setDestination($this->destination())
            ->transform($arguments);
    }

    protected function stub()
    {
        return __DIR__ . '/../../Stubs/module/registration.php.stub';
    }

    protected function destination()
    {
        $vendor = $this->getVendor();

        $module = $this->getModule();

        return "app/code/$vendor/$module/registration.php";
    }
}

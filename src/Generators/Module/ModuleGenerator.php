<?php

namespace Napoleon\Magento\Generators\Module;

use Napoleon\Magento\Generators\Generator;
use Napoleon\Support\Transformer\Transformer;
use Napoleon\Magento\Generators\GeneratorInterface;

class ModuleGenerator extends Generator implements GeneratorInterface
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
        return __DIR__ . '/../../Stubs/module/etc/module.xml.stub';
    }

    protected function destination()
    {
        $vendor = $this->getVendor();

        $module = $this->getModule();

        return "app/code/$vendor/$module/etc/module.xml";
    }
}

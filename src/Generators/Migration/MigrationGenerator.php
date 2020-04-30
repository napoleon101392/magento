<?php

namespace Napoleon\Magento\Generators\Migration;

use Napoleon\Magento\Generators\Generator;
use Napoleon\Support\Transformer\Transformer;
use Napoleon\Magento\Generators\GeneratorInterface;

class MigrationGenerator extends Generator implements GeneratorInterface
{
    public function publish()
    {
        $arguments = [
            '{NAMESPACE}' => $this->getVendor() . "\\" . $this->getModule() . '\\' . 'Setup'
        ];

        return (new Transformer)
            ->stub($this->stub())
            ->setDestination($this->destination())
            ->transform($arguments);
    }

    protected function stub()
    {
        return __DIR__ . '/../../Stubs/module/Setup/InstallSchema.php.stub';
    }

    protected function destination()
    {
        $vendor = $this->getVendor();

        $module = $this->getModule();

        return "app/code/$vendor/$module/Setup/InstallSchema.php";
    }
}

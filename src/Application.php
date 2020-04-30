<?php

namespace Napoleon\Magento;

use Magento\Framework\DB\Ddl\Table;
use Napoleon\Magento\Generators\Module\ModuleGenerator;
use Napoleon\Magento\Generators\Migration\MigrationGenerator;
use Napoleon\Magento\Generators\Partials\RegistrationGenerator;

class Application
{
    protected $vendor;

    protected $module;

    public function __construct($vendor, $module)
    {
        $this->vendor = $vendor;

        $this->module = $module;
    }

    public function fire()
    {
        $generators = [
            RegistrationGenerator::class,
            ModuleGenerator::class,
            MigrationGenerator::class
        ];

        $errors = [];
        $success = [];

        foreach ($generators as $generator) {
            $generator = new $generator(
                $this->vendor,
                $this->module
            );

            try {
                $generator->publish();
            } catch (\Exception $e) {
                $errors[] = get_class($generator);

                continue;
            }

            $success[] = get_class($generator);
        }

        return json_encode([
            'errors' => $errors,
            'success' => $success
        ]);
    }
}

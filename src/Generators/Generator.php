<?php

namespace Napoleon\Magento\Generators;

abstract class Generator
{
    protected $vendor;

    protected $module;

    public function __construct($vendor, $module)
    {
        $this->vendor = $vendor;

        $this->module = $module;
    }

    protected function getVendor()
    {
        return $this->vendor;
    }

    protected function getModule()
    {
        return $this->module;
    }
}

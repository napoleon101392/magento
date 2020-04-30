<?php

namespace Napoleon\Magento\Tests;

use Napoleon\Magento\Application;
use PHPUnit\Framework\TestCase;

class ApplicationTest extends TestCase
{
    /** @test */
    public function executeGenerators()
    {
        $response = (new Application('Vendor', 'Module'))->fire();

        $errors = json_decode($response)->errors;

        $this->assertTrue(empty($errors));
    }

    /** @test */
    public function executeMultipleGenerators()
    {
        (new Application('Vendor', 'Module'))->fire();

        $response = (new Application('Vendor', 'Module'))->fire();

        $errors = json_decode($response)->errors;

        $this->assertTrue(! empty($errors));
    }

    public function tearDown()
    {
        $code = scandir($baseDir = __DIR__ . "/../../../app/code");

        if (in_array("Vendor", $code)) {
            $this->delete_directory($baseDir . "/Vendor");
        }
    }

    private function delete_directory($dirname)
    {
        if (is_dir($dirname)) {
            $dir_handle = opendir($dirname);
        }

        if (!$dir_handle) {
            return false;
        }

        while ($file = readdir($dir_handle)) {
            if ($file != "." && $file != "..") {
                if (!is_dir($dirname . "/" . $file)) {
                    unlink($dirname . "/" . $file);
                } else {
                    self::delete_directory($dirname . '/' . $file);
                }
            }
        }

        closedir($dir_handle);
        rmdir($dirname);
        return true;
    }
}

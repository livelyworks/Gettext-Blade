<?php
declare(strict_types=1);

namespace Unn\GettextBlade\Scanner;

use Gettext\Scanner\FunctionsHandlersTrait;
use Gettext\Scanner\FunctionsScannerInterface;
use Gettext\Scanner\PhpScanner;

class Blade extends PhpScanner
{
    use FunctionsHandlersTrait;

    protected $functions = [
        '__' => 'gettext',
        '_i' => 'gettext',
        '_n' => 'ngettext',
    ];

    /**
     * Retrieve a scanner for Blade functions.
     *
     * @return FunctionsScannerInterface
     */
    public function getFunctionsScanner(): FunctionsScannerInterface
    {
        return new BladeFunctions(array_keys($this->functions));
    }

    /**
     * Scans Blade files for translateable strings.
     *
     * @param string $string
     * @param string $filename
     * @return void
     */
    public function scanString(string $string, string $filename): void
    {
        // let the PHP scanner do its magic
        parent::scanString($string, $filename);
    }
}

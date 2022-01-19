<?php

namespace Unn\GettextBlade\Scanner;

use Gettext\Scanner\PhpFunctionsScanner;
use Illuminate\Filesystem\Filesystem;
use Illuminate\View\Compilers\BladeCompiler;

class BladeFunctions extends PhpFunctionsScanner
{
    /**
     * @var CompilerInterface
     */
    protected static $compiler;

    /**
     * Compiles and scans Blade code for translateable strings.
     *
     * @param string $code
     * @param string $filename
     * @return array
     */
    public function scan(string $code, string $filename): array
    {
        $code = $this->compileCode($code);

        return parent::scan($code, $filename);
    }

    /**
     * Retrieves an instance of a BladeCompiler. Creates one if non-existent.
     *
     * @return BladeCompiler
     */
    protected function getCompiler(): BladeCompiler
    {
        if (!static::$compiler) {
            static::$compiler = new BladeCompiler(new Filesystem(), sys_get_temp_dir());
        }

        return static::$compiler;
    }

    /**
     * Compiles Blade code utilizing BladeCompiler.
     *
     * @param string $code
     * @return string
     */
    protected function compileCode(string $code): string
    {
        $compiler = $this->getCompiler();
        return $compiler->compileString($code);
    }
}

<?php

namespace SimpleRest\Autoload;

/**
 * PSR-4 Autoloader
 *
 * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-4-autoloader-examples.md
 *
 * @author po_taka <angel.koilov@gmail.com>
 */
class Autoloader
{
    protected $namespace;
    protected $includePath;
    
    /**
     * @param string $namespace namespace to registed
     * @param string $includePath path to look for files
     */
    public function __construct($namespace, $includePath)
    {
        $this->includePath = $includePath;
        $this->namespace = $namespace;
    }

    /**
     * Register the autoloader
     */
    public function register()
    {
        \spl_autoload_register([$this, 'autoload']);
    }
    
    /**
     * Try to find class
     * @param string $className
     */
    public function autoload($className)
    {
        $filepath = str_replace('\\', DIRECTORY_SEPARATOR, $className);
        
        $relativePath = preg_replace(
            '#^' . preg_quote($this->namespace, '#') . '#',
            '',
            $filepath
        );
        
        $relativePath .= '.php';
        
        $fileFullPath = $this->includePath . DIRECTORY_SEPARATOR . $relativePath;
        
        if (is_file($fileFullPath)) {
            require $fileFullPath;
            return true;
        }
        
        return false;
    }
}

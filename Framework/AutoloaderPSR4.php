<?php

namespace Frame;

class AutoloaderPSR4
{

    const cache = __DIR__ . "/cache/autoloader.php";

    private $classList = [];

    /**
     * Create config
     */
    static $config =     [
        'App' => 'App/includes/',
        'Frame' => 'Frame/',
    ];

    /**
     * 
     */
    function __construct()
    {
        $this->autoload();
        $this->registre();
    }

    /**
     *  
     */
    function autoload()
    {
        if (file_exists(self::cache))
            $this->classList = include self::cache;
        foreach ($this->classList as $key => $filename) {
            if (file_exists($filename)) {
                include_once $filename;
            } else {
                unset($this->classList[$key]);
                $this->save();
            }
        }
    }

    /**
     * Registre self::registre method as Autoloader register methode.
     */
    function registre()
    {
        spl_autoload_register([self::class, 'registrer']);
    }

    /**
     * Registre Class
     */
    function registrer($class)
    {
        $parts = explode('\\', $class);
        $classname = array_pop($parts);
        array_shift($parts);

        foreach (self::$config as $namespace => $folder) {
            if (!file_exists($folder)) {
                unset(self::$config[$namespace]);
            } else if (
                empty($namespace) ||
                (false !== strpos($class, $namespace, 0))
            ) {
                $filename = $folder . '/' . implode('/', $parts) . '/' . $classname . '.php';
                $this->getFile($filename, $class);
            }
        }
    }

    /**
     * Load file
     */
    function getFile($filename, $class)
    {
        if (file_exists($filename)) {
            include_once $filename;
            $this->classList[$class] = $filename;
            $this->save();
        }
    }

    /**
     * Save file
     */
    function save()
    {
        $str = "<?php return [\n";
        foreach ($this->classList as $key => $filename) {
            $key = str_replace('\\', '\\\\', $key);
        }
        $str .= "];\n";
        file_put_contents(self::cache, $str);
    }
}

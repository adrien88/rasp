<?php

namespace Frame;

use Exception;

class Config
{

    const support = ['array', 'string', 'integer', 'double', 'boolean', 'NULL'];
    private $filename = null;

    private $data = [];

    /**
     * Staticly from a file.
     * 
     * @param string $filename 
     * @return self 
     */
    static function From(string $filename)
    {
        return new self($filename);
    }

    /**
     * Config constructor.
     *      Load file if exist
     *      Create if don't
     * 
     * @param string $filaneme
     * @return self
     */
    function __construct(string $filename)
    {
        $this->file = fopen($filename, 'w+');

        if (file_exists($filename)) {
            $this->load($filename);
            $this->filename = $filename;
        } else
            $this->save($filename);
    }


    /**
     * Magic setting value : keep only supported format.
     * 
     * @param string $name
     */
    function __set(string $name, $value): void
    {
        $name = Sanitize::variableName($name);
        if (in_array(gettype($value), self::support)) {
            $this->$name = $value;
        } else
            throw new Exception('Ressources, objects and other customs types are not supported yet by Config class.');
    }


    /**
     * Save on a file.
     * Onfail: throw new Exception.
     * 
     * @param string $filename
     * @return bool
     */
    function save(string $filename = null): bool
    {
        $filename = $filename ?? $this->filename;
        if (!file_put_contents($filename, $this->format())) {
            throw new Exception("PHP can't find/read $filename.");
            return false;
        }
        $this->filename = $filename;
        return true;
    }

    /**
     * Load from a file.
     * Onfail: throw new Exception.
     * 
     * @param string $filename
     * @return bool
     */
    function load(string $filename): bool
    {
        $data = include $filename;
        if (is_array($data)) {
            foreach ($data as $key => $value) $this->$key = $value;
            $this->filename = $filename;
            return true;
        } else
            throw new Exception("PHP can't find/read $filename.");
        return false;
    }

    /**
     * Format array data
     * 
     * @param array $data
     * @return string
     */
    function format(array $data = null, int $lvl = 1): string
    {
        $str = (1 == $lvl) ? '<?php return [' : '[';
        $t = str_repeat("\t", $lvl);

        foreach (($data ?? get_object_vars($this)) as $key => $value) {

            if (is_string($key) && $key != "")
                $key = '"' . Sanitize::variableName($key) . '" => ';
            else $key = '';

            switch (gettype($value)) {
                case 'array':
                    $value = $this->format($value, ($lvl + 1));
                    break;
                case 'string':
                    $value = Sanitize::string($value);
                    break;
                case 'boolean':
                    $value = (true === $value) ? "true" : "false";
                    break;
                case 'integer':
                case 'double':
                    break;
                case 'NULL':
                    $value = 'null';
                    break;
            }
            $str .= "\n$t" . $key . $value . ",";
        }
        return  $str . "\n$t]" . ((1 == $lvl) ? ';' : '');
    }
}

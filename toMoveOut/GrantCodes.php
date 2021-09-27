<?php

namespace Frame;

use Exception;

class GrantCodes
{

    /**
     * On read-only.
     */
    private array $code = [
        'u' => ['r' => true,  'w' => true,  'x' => true],
        'g' => ['r' => true,  'w' => true,  'x' => false],
        'o' => ['r' => false, 'w' => false, 'x' => false]
    ];

    /**
     * Read the code.
     */
    function __construct(string $code = null)
    {
        if (isset($code)) $this->getCode($code);
    }

    /**
     * Read a string code.
     * 
     * @param string $code
     * @return void
     */
    function getCode(string $code)
    {
        $k = array_keys($this->code);
        $sk = array_keys($this->code[$k[0]]);
        foreach (str_split($code, 3) as $nk => $us)
            foreach (str_split($us) as $rk => $rp)
                if ('-' != $rp && in_array($rp, $sk))
                    $this->code[$k[$nk]][$rp] = true;
                else
                    $this->code[$k[$nk]][$sk[$rk]] = false;
    }

    /**
     * Return a string code.
     * 
     * @param void
     * @return string
     */
    function __toString(): string
    {
        $str = '';
        foreach ($this->code as $block)
            foreach (array_keys($block) as $p)
                $str .= (true == $block[$p]) ? $p : '-';
        return $str;
    }

    /**
     * 
     */
    function __get($name)
    {
        if ('code' === $name) return $this->code;
    }

    /**
     * Toggle value
     * 
     * @param string $u type user 
     *      > u = user, g = group, o = other
     * @param string $p type right
     *      > r = read, w = write, x = execute
     * 
     */
    function toggle(string $u, string $p)
    {
        if (isset($this->code[$u][$p]))
            $this->code[$u][$p] = ($this->code[$u][$p]) ? true : false;
        return $this->code[$u][$p];
    }



    function isUserReadable(): bool
    {
        return $this->code["u"][0];
    }

    function isUserWritable(): bool
    {
        return $this->code["u"][1];
    }

    function isUserExecutable(): bool
    {
        return $this->code["u"][2];
    }

    function isGroupReadable(): bool
    {
        return $this->code["g"][0];
    }

    function isGroupWritable(): bool
    {
        return $this->code["g"][1];
    }

    function isGroupExecutable(): bool
    {
        return $this->code["g"][2];
    }

    function isOhterReadable(): bool
    {
        return $this->code["o"][0];
    }

    function isOtherWritable(): bool
    {
        return $this->code["o"][1];
    }

    function isOtherExecutable(): bool
    {
        return $this->code["o"][2];
    }
}

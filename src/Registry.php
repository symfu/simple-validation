<?php
namespace Symfu\SimpleValidation;

// <editor-fold defaultstate="collapsed" desc="use namespaces">
use Symfony\Component\HttpFoundation\ParameterBag;
// </editor-fold>

class Registry
{
    /**
     * Parameter storage.
     */
    protected $parameters = [];

    private static $instances = [];

    /**
     *
     * @param type $name
     * @return Registry
     */
    public static function getRegistry($name = 'default')
    {
        if(!isset(self::$instances[$name]))
        {
            self::$instances[$name] = new self();
        }

        return self::$instances[$name];
    }


    /**
     * Returns a parameter by name.
     *
     * @param string $key     The key
     * @param mixed  $default The default value if the parameter key does not exist
     *
     * @return mixed
     */
    public function get($key, $default = null)
    {
        return array_key_exists($key, $this->parameters) ? $this->parameters[$key] : $default;
    }

    /**
     * Sets a parameter by name.
     *
     * @param string $key   The key
     * @param mixed  $value The value
     */
    public function set($key, $value)
    {
        $this->parameters[$key] = $value;
    }

    /**
     * Returns true if the parameter is defined.
     *
     * @param string $key The key
     *
     * @return bool true if the parameter exists, false otherwise
     */
    public function has($key)
    {
        return array_key_exists($key, $this->parameters);
    }

    /**
     * Removes a parameter.
     *
     * @param string $key The key
     */
    public function remove($key)
    {
        unset($this->parameters[$key]);
    }

}

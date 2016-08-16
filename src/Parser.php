<?php

namespace MrCrankHank\LvmParser;

use Illuminate\Support\Collection;
use MrCrankHank\LvmParser\Exceptions\MethodNotFoundException;

class Parser
{
    const SEPARATOR = '|';

    private $string;

    private $type;

    public function __construct($string)
    {
        $this->string = $string;
    }

    public function parse()
    {
        $method = '_get' . ucfirst($this->type);

        if (method_exists($this, $method)) {
            return call_user_func([$this, $method]);
        } else {
            throw new MethodNotFoundException;
        }
    }

    public function type($type)
    {
        $this->type = $type;

        return $this;
    }

    private function _parse($string)
    {
        $data = collect(explode("\n", $string));

        // remove spaces and the ending/beginning
        $data->transform(function ($line, $key) {
            $line = preg_replace('/[\r\n]|[\r]+/', '', $line);
            return trim($line, ' ');
        });

        // delete warning messages from pvs/vgs/lvs output
        if (strpos($data[0], 'WARNING:') !== false) {
            $data->forget(0);
            $data = $data->values();
        }

        // get keys for associative array
        $heading = collect(explode(self::SEPARATOR, $data[0]));
        $data->forget(0);

        $heading->transform(function($line, $key) {
            return str_replace('#', '', $line);
        });

        // create a array for every line and set the heading
        $data->transform(function ($line, $key) use ($heading) {
            $array = explode(self::SEPARATOR, $line);
            return $heading->combine($array);
        });

        return $data->values();
    }

    private function _getLvs()
    {
        $data = $this->_parse($this->string);

        $keys = ['LSize'];

        $data = $this->_stripChars($data, $keys);

        return $data;
    }

    private function _getVgs()
    {
        $data = $this->_parse($this->string);

        $keys = ['VSize', 'VFree'];

        $data = $this->_stripChars($data, $keys);

        return $data;
    }

    private function _getPvs()
    {
        $data = $this->_parse($this->string);

        $keys = ['PSize', 'PFree'];

        $data = $this->_stripChars($data, $keys);

        return $data;
    }

    /**
     * Strip chars from the given keys in the collection
     *
     * @param $data
     * @param $keys
     * @return mixed
     */
    private function _stripChars(Collection $data, $keys)
    {
        foreach ($keys as $key) {
            foreach ($data as $array) {
                if ($array->has($key)) {
                    $value = preg_replace("/[^0-9]/","", $array->get($key));
                    $array->put($key, $value);
                }
            }
        }

        return $data;
    }
}
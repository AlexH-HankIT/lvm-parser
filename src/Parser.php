<?php

namespace MrCrankHank\LvmParser;

use Illuminate\Support\Collection;

class Parser {
    public function get($string)
    {
        $data = collect(explode("\n", $string));

        // remove spaces and the ending/beginning
        $data = $data->map(function ($line, $key) {
            return trim($line, ' ');
        });

        // delete warning messages from pvs/vgs/lvs output
        if (strpos($data[0], 'WARNING:') !== false) {
            unset($data[0]);
            $data = $data->values();
        }

        // get keys for associative array
        $heading = explode('*', $data[0]);
        unset($data[0]);

        $data = $data->map(function ($line, $key) {
            return explode('*', $line);
        });
    }
}
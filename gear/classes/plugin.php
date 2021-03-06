<?php

class plugin {

    protected $config = [];
    protected static $allPlugins = [];

    public function __construct($name) {

        $file = dir::plugins('plugin.json', $name);

        if(file_exists($file)) {
            $this->config = json_decode(file_get_contents($file), true);
        }

    }

    public function getConfig() {
        return $this->config;
    }

    public function get($key, $default = null) {

        if(isset($this->config[$key])) {
            return $this->config[$key];
        }

        return $default;

    }

    public static function getAll() {

        if(!count(self::$allPlugins)) {

            $active = unserialize(option::get('plugins'));
            $active = (!is_array($active)) ? [] : $active;

            $plugins = array_diff(scandir(dir::plugins()), ['.', '..']);

            foreach($plugins as $dir) {

                $plugin = new self($dir);

                self::$allPlugins[] = array_merge([
                    'id' => $dir,
                    'active' => in_array($dir, $active)
                ], $plugin->getConfig());

            }

        }

        return self::$allPlugins;

    }

}

?>

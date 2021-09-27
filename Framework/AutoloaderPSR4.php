<?php

namespace Frame;

/**
 * APP = "includes/"
 */
class AutoloaderPSR4
{

	const cache = __DIR__ . "/cache/autoloader.php";
	private $classList = [];

	static $config = [];

	/**
	 *
	 */
	static function auto()
	{
		new self;
	}

	/**
	 *
	 */
	private function __construct()
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
	 *
	 */
	function registre()
	{
		spl_autoload_register([self::class, 'registrer']);
	}

	function registrer($class)
	{
		$parts = explode('\\', $class);
		$classname = array_pop($parts);
		array_shift($parts);
		foreach (self::$config as $namespace => $folder) {
			$this->getAutoloadComposer($folder);
			if (!file_exists($folder))
				unset(self::$config[$namespace]);
			if (empty($namespace) || (false !== strpos($class, $namespace, 0) && self::isDevClassComposer($folder, $namespace))) {
				$filename = $folder . '/' . implode('/', $parts) . '/' . $classname . '.php';
				if (file_exists($filename)) {
					include_once $filename;
					$this->classList[$class] = $filename;
					$this->save();
				}
			}
		}
	}


	/**
	 *
	 */
	function save()
	{
		$str = "<?php return [\n";
		foreach ($this->classList as $key => $filename) {
			$key = str_replace('\\', '\\\\', $key);
			$str .= "\t\"" . $key . '"=>"' . $filename . '",' . "\n";
		}
		$str .= "];\n";
		file_put_contents(self::cache, $str);
	}

	/**
	 * Test if composer json say is dec
	 * DEV class may not saved on cache.
	 *
	 */
	static function isDevClassComposer(string $folder, string $namespace): bool
	{
		if (file_exists($folder . '/composer.json')) {
			$param = json_decode(file_get_contents($folder . '/composer.json'));
			foreach ($param['autoload-dev'] ?? [] as $name => $folders)
				if (false !== strpos($namespace, $name)) return false;
		}
		return true;
	}

	/**
	 * Get composer namespace.
	 *
	 */
	function getAutoloadComposer(string $folder)
	{
		if (file_exists($folder . '/composer.json')) {
			$param = json_decode(file_get_contents($folder . '/composer.json'));
			if (isset($param['autoload']))
				foreach ($param['autoload'] as $namespace => $folder) {
					if (!in_array($namespace, array_keys(self::$config)))
						if (is_array($folder)) {
						} else {
							self::$config[$namespace] = $folder;
							return true;
						}
				}
		}
		return false;
	}
}

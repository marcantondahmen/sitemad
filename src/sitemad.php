<?php
/**
 *	Sitemad
 *
 *	Copyright 2020 by Marc Anton Dahmen
 *	https://marcdahmen.de
 *	MIT License
 */
class Sitemad {
	private $baseDir;

	private $baseUrl;

	private $config;

	private $phpVersion;

	private $serverName;

	private $serverType;

	private $sitemadUrl;

	public function __construct() {
		$this->serverName = getenv('SERVER_NAME');
		$this->serverType = preg_replace('/\/.*/', '', getenv('SERVER_SOFTWARE'));
		$this->phpVersion = phpversion();
		$this->sitemadUrl = preg_replace('/\/index\.php$/', '', getenv('SCRIPT_NAME'));
		$this->baseDir = rtrim(str_replace('\\', '/', dirname(dirname(__DIR__))), '/');
		$this->baseUrl = dirname($this->sitemadUrl);
		$this->config = $this->getConfig();

		echo $this->generateOutput();
	}

	private function generateOutput() {
		$rows = $this->generateRows();

		return require __DIR__ . '/templates/page.php';
	}

	private function generateRows() {
		$sites = $this->scan($this->baseDir);
		$html = '';

		foreach ($sites as $path) {
			$url = $this->urlFromPath($path);
			$separator = '<svg class="text-muted" xmlns="http://www.w3.org/2000/svg" width="0.7em" height="0.7em" fill="currentColor" class="bi bi-chevron-right" viewBox="0 0 16 16"><path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z"/></svg>';
			$text = str_replace('/', " $separator ", trim($url, '/'));
			$dashboard = '';
			$proxy = '';

			foreach ($this->config->dashboards as $item => $slug) {
				if (is_readable("$path$item")) {
					$dashboard = '<a href="' . $url . $slug . '" class="btn btn-sm btn-rounded" target="_blank">Login</a>';
				}
			}

			foreach ($this->config->proxies as $item => $proxyUrl) {
				if (is_readable("$path$item")) {
					$proxy = '<a href="' . $proxyUrl . $url . '" class="proxy ml-10 btn btn-sm btn-rounded btn-success" target="_blank">Proxy</a>';
				}
			}

			$html .= require __DIR__ . '/templates/row.php';
		}

		return $html;
	}

	private function getConfig() {
		$defaults = json_decode(file_get_contents(dirname(__DIR__) . '/defaults.json'), true);
		$config = array();
		$configFile = dirname(__DIR__) . '/config.json';

		if (is_readable($configFile)) {
			$config = json_decode(file_get_contents($configFile), true);
		}

		return (object) array_merge($defaults, $config);
	}

	private function scan($dir, $depth = 0) {
		$sites = array();

		if ($depth > $this->config->maxdepth) {
			return array();
		}

		if ($depth > 0) {
			foreach (array('php', 'htm', 'html') as $ext) {
				if (is_readable("$dir/index.$ext")) {
					$sites[] = str_replace('\\', '/', $dir);
				}
			}
		}

		$items = glob("$dir/*", GLOB_ONLYDIR);

		if (is_array($items)) {
			$items = array_filter($items, function ($item) {
				return !preg_match('/(' . $this->config->ignore . ')/', $item);
			});

			foreach ($items as $item) {
				$sites = array_merge($sites, $this->scan($item, $depth + 1));
			}
		}

		return $sites;
	}

	private function urlFromPath($path) {
		return preg_replace('/^' . preg_quote($this->baseDir, '/') . '\/?/', $this->baseUrl, $path);
	}
}

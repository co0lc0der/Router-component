<?php

class Router
{
	private $routes = [];
	private $view;
	private $path;

	public function __construct(array $routes, $path) {
		$this->path = $path;
		foreach ($routes as $route => $view) {
			$this->add($route, $view);
		}
	}

	private function getRouteFromUrl() {
		$uri = $_SERVER['REQUEST_URI'];
    $url = filter_var(rtrim($uri, '/'), FILTER_SANITIZE_URL);
    return $url;
  }

	private function add($route, $view) {
		$route = '#^' . $route . '$#';
		$this->routes[$route] = $view;
	}

	private function match() {
		$url = $this->getRouteFromUrl();
		foreach ($this->routes as $route => $view) {
			if (preg_match($route, $url, $matches)) {
				$this->view = $view;
				return true;
			}
		}
		return false;
	}

	public function run() {
		if ($this->match()) {
			$file = $this->path . $this->view . '.view.php';
			if (file_exists($file)) {
				require $file;
				return;
			}
		}

		http_response_code(404);
		require $this->path . '404.view.php';
		return;
	}
}

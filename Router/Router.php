<?php
/**
 * Class Router
 */
class Router
{
	/**
	 * @var array
	 */
	private array $routes = [];

	/**
	 * @var string
	 */
	private string $view;

	/**
	 * @var string
	 */
	private string $path;

	/**
	 * @param array $routes
	 * @param string $path
	 */
	public function __construct(array $routes, string $path)
	{
		$this->path = $path;
		foreach ($routes as $route => $view) {
			$this->add($route, $view);
		}
	}

	/**
	 * @return string
	 */
	private function getRouteFromUrl(): string
	{
    return filter_var(rtrim($_SERVER['REQUEST_URI'], '/'), FILTER_SANITIZE_URL);
  }

	/**
	 * @param string $route
	 * @param string $view
	 * @return void
	 */
	private function add(string $route, string $view): void
	{
		$route = '#^' . $route . '$#';
		$this->routes[$route] = $view;
	}

	/**
	 * @return bool
	 */
	private function match(): bool
	{
		$url = $this->getRouteFromUrl();

		foreach ($this->routes as $route => $view) {
			if (preg_match($route, $url, $matches)) {
				$this->view = $view;
				return true;
			}
		}

		return false;
	}

	/**
	 * @return void
	 */
	public function run(): void
	{
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

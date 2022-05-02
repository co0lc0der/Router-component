# Router php component

This is easy-to-use php component for routing URLs in your project. See `index.php` for examples.
### Public methods:
- `run()` - runs routing
## How to use
### 1. Include config file and set `tplpath` parameter. Add routes into the section below.
- `index.php`
```php
$config = require __DIR__ . '/Router/config.php';
```
- `config.php`
```php
'tplpath' => __DIR__ . '/../templates/',
'routes' => [
  '' => 'index',
  '/login' => 'login',
  '/profile' => 'profile',
]
```
### 2. Create files according the routes you added.
A file must be called `2nd_part_of_route.view.php`. For example we have a route `'/about'	=> 'about_us'` therefore the file must be `about_us.view.php` and be placed into `templates` folder (`tplpath` parameter). If a file cannot be found Router shows `404.view.php` from `templates` folder.
```
templates/
  404.view.php
  index.view.php
  login.view.php
```
### 3. Include Router class and init it with `routes` array and `tplpath` from config.
```php
require __DIR__ . '/Router/Router.php';

$router = new Router($config['routes'], $config['tplpath']);
```
### 4. Now just run it.
```php
$router->run();
```

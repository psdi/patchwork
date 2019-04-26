# Patchwork-Framework

This project is a conglomerate created by bundling interpretations of existing
technologies. Although not apt for official project usage, this framework should
allow implementation of common features that other, more superior frameworks
already provide. Ultimately, it only serves learning purposes.

## Usage

### Autoloading

In `src/autoload.php`, instantiate an `Autoloader` object with its single parameter, the path to the `src` folder.

```php
$frameworkPath = rtrim(dirname(__FILE__), DIRECTORY_SEPARATOR).'/';
$loader = new Library\Autoloader($frameworkPath);
```

Loading namespace prefixes can be done in three ways. The easiest way to add a namespace-directory pair is by using the `addNamespace()` method, like so:

```php
$loader->addNamespace('Library', 'lib/');
```

A "map" (array) of namespaces can be registered at once with the help of `addNamespaceMap()`:

```php
$loader->addNamespaceMap([
   'Library' => 'lib/',
   'Routing' => 'routing/',
]);
```

Last but not the least, a method based on Nikita Popov's routing system that allows group namespace addition:

```php
$loader->addNamespaceGroup('BlogPost', 'Object/', function (Library\Autoloader $a) {
	'Interface' => 'Interface/',
    'Object' => 'Object/',
    'Request' => 'Request/',
});
```

After that, register the autoload function using the `register` method.

```php
$loader->register();
```



At the end of the yet unknown project period, this *framework* should have the following features:

- Logging
- Autoloading
- Routing: Controllers/Views
- Template Engine
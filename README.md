# Patchwork

The aim of this project is to emulate common features that other, more superior
frameworks already provide. With that said, it is in no way suitable for usage
in production.

## Implemented Features

- Logging (based on Katzgrau's [Logger](https://github.com/katzgrau/KLogger/blob/master/src/Logger.php)) class
- Autoloading (taken and adapted from PHP FIG's [example](https://www.php-fig.org/psr/psr-4/examples/))
- Routing (loosely inspired by Zend Expressive + Slim + FastRoute) (basically every routing framework there is 😅)

## To-do

- MVC-conforming workflow, or perhaps RMR
- Middleware support
- Using interfaces and abstraction (e.g. for different types of requests)
- Template Engine (not very sure about this)

Documentation coming soon!
**Deprecated**

Service Provider para Slim 3
======================

[![Build Status](https://travis-ci.org/mostofreddy/slim-service-provider.svg?branch=master)](https://travis-ci.org/mostofreddy/slim-service-provider)

Permite reutilizar códigos de otras aplicaciones o librerías a travez de una clase Provider para poder abstraer su inicialización y configuración.

# Versión

0.2.4

# License

The MIT License (MIT). Ver el archivo [LICENSE](LICENSE.md) para más información

# Changelog

Ver archvio [CHANGELOG](CHANGELOG.md)

# Documentación

Instalación
-----------

Agregar en el archivo `composer.json`

```
{
    "require": {
        "restyphp/slim-service-provider": "0.2.*"
    }
}
```

Cargar un Provider
-----------------

Para poder utilizar un servicio, primero se debe registrar en la aplicación cada uno de los servicios en un array de configuración. En este array debe estar el nombre de la clase (incluye el namespace completo). Luego se registra el Middleware que se encargara de registrar cada Servicio.

```
$config = [];

// configuración de Silex
$config['settings'] = [
    // slim config
];

// Configuración de los providers
$config['services'] = [
    '\ServiceProvider'
];

$app = new \Slim\App($config);

// Se registra el middleware (para todas las rutas) que se encarga de inicializar y dejar disponibles todos los servicios
$app->add('\Resty\Slim\ServiceProviderMiddleware');

// ...
$app->run();
```

También es posible registrar el Middleware para una ruta (o conjunto de rutas) en particular.

Crear un Provider
-----------------

Todos los Provider extienden de la clase abstracta `Resty\Slim\AbstractServiceProvider`

```
use Resty\Slim\AbstractServiceProvider;
use Slim\Container;

class ServiceProvider extends AbstractServiceProvider
{
    public static function register(Container $c)
    {
        $c['service'] = function () {
            $o = new \StdClass();
            $o->saludo = "Hola";
            return $o;
        };
    }

    public static function boot(Container $c)
    {
    }
}
```

El método `register()` sirve para crear los servicios del proveedor y registrarlos en la aplicación. El método `boot()` sirve para configurar la aplicación antes de que empiece a procesar las peticiones del usuario.

Una vez que el servicio esta registrado queda disponible para ser obtenido desde el Container de Slim

```
$app->get('/', function (ServerRequestInterface $request, ResponseInterface $response) {
    
    // Obtención del servicio
    $service = $this->get('service');

    $body = $response->getBody();
   
    $body->write($service->saludo);
    
    return $response;
});

```


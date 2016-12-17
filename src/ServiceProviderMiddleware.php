<?php
/**
 * ServiceProviderMiddleware
 *
 * PHP version 7+
 *
 * Copyright (c) 2016 Federico Lozada Mosto <mosto.federico@gmail.com>
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 *
 * @category  Resty
 * @package   Resty\Interfaces
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2016 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
namespace Resty\Slim;

use Slim\Container;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;
/**
 * ServiceProviderMiddleware
 *
 * @category  Resty
 * @package   Resty\Interfaces
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2016 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
class ServiceProviderMiddleware
{
    protected $container;

    /**
     * Contructor
     * 
     * @param Container $container Instancia de Container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * Middleware
     *
     * @param \Psr\Http\Message\ServerRequestInterface $request  PSR7 request
     * @param \Psr\Http\Message\ResponseInterface      $response PSR7 response
     * @param callable                                 $next     Next middleware
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function __invoke(ServerRequestInterface $request, ResponseInterface $response, $next):ResponseInterface
    {
        $services = $this->container['services'];

        if (is_array($services)) {
            foreach ($services as $service) {
                $service::register($this->container);
                $service::boot($this->container);
            }
        }

        $response = $next($request, $response);

        return $response;
    }
}

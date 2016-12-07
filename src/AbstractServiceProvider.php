<?php
/**
 * AbstractServiceProvider
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
namespace Resty;

use Slim\Container;
/**
 * AbstractServiceProvider
 *
 * @category  Resty
 * @package   Resty\Interfaces
 * @author    Federico Lozada Mosto <mosto.federico@gmail.com>
 * @copyright 2016 Federico Lozada Mosto <mosto.federico@gmail.com>
 * @license   MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @link      http://www.mostofreddy.com.ar
 */
abstract class AbstractServiceProvider
{
    /**
     * Registra el servicio
     *
     * @param Container $container Instancia de la aplicacion
     *
     * @return void
     */
    abstract public static function register(Container $container);
    /**
     * Inicializa un servicio
     * 
     * @param Container $container Instancia de la aplicacion
     *
     * @return void
     */
    public static function boot(Container $container)
    {
    }
}

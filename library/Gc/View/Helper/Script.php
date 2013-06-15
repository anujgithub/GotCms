<?php
/**
 * This source file is part of GotCms.
 *
 * GotCms is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * GotCms is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public License along
 * with GotCms. If not, see <http://www.gnu.org/licenses/lgpl-3.0.html>.
 *
 * PHP Version >=5.3
 *
 * @category   Gc
 * @package    Library
 * @subpackage View\Helper
 * @author     Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license    GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link       http://www.got-cms.com
 */

namespace Gc\View\Helper;

use Gc\Script\Model as ScriptModel;
use Gc\View\Stream;
use Zend\View\Helper\AbstractHelper;
use Zend\Http\PhpEnvironment\Request;
use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\PluginManager;

/**
 * Retrieve script from identifier
 *
 * @category   Gc
 * @package    Library
 * @subpackage View\Helper
 * @example In view: $this->script('identifier');
 */
class Script extends AbstractHelper
{
    /**
     * Script parameter
     *
     * @var array
     */
    protected $__params = array();

    public function __construct(Request $request, Response $response, PluginManager$pluginManager)
    {
        $this->request       = $request;
        $this->response      = $response;
        $this->pluginManager = $pluginManager;
    }

    /**
     * Returns script from identifier.
     *
     * @param string $identifier Identifier
     * @param array  $params     Parameters
     *
     * @return mixed
     */
    public function __invoke($identifier, $params = array())
    {
        Stream::register('gc.script', false);

        $script = ScriptModel::fromIdentifier($identifier);
        if (empty($script)) {
            return false;
        }

        $this->__params = $params;
        $name           = $identifier . '-script.gc-stream';

        file_put_contents('gc.script://' . $name, $script->getContent());

        return include 'gc.script://' . $name;
    }

    /**
     * Returns param from name.
     *
     * @param string $name Parameter name
     *
     * @return mixed
     */
    public function getParam($name)
    {
        if (isset($this->__params[$name])) {
            return $this->__params[$name];
        }

        return null;
    }

    /**
     * Returns param from name.
     *
     * @return \Gc\Document\Model
     */
    public function getDocument()
    {
        return $this->getView()->layout()->currentDocument;
    }

    /**
     * Get Http Request instance.
     *
     * @return \Zend\Http\PhpEnvironment\Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * Get Http Response instance.
     *
     * @return \Zend\Http\PhpEnvironment\Response
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get plugin instance
     *
     * @param string     $name    Name of plugin to return
     * @param null|array $options Options to pass to plugin constructor (if not already instantiated)
     *
     * @return mixed
     */
    public function plugin($name, array $options = null)
    {
        return $this->pluginManager->get($name, $options);
    }

    /**
     * Method overloading: return/call plugins
     *
     * If the plugin is a functor, call it, passing the parameters provided.
     * Otherwise, return the plugin instance.
     *
     * @param string $method Method
     * @param array  $params Parameters
     *
     * @return mixed
     */
    public function __call($method, $params)
    {
        $plugin = $this->plugin($method);
        if (is_callable($plugin)) {
            return call_user_func_array($plugin, $params);
        }

        return $plugin;
    }
}

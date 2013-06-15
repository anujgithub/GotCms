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
 * @category   Gc_Library
 * @package    Library
 * @subpackage View\Helper
 * @author     Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license    GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link       http://www.got-cms.com
 */

namespace Gc\View\Helper;

use Gc\Core\Config as CoreConfig;
use Zend\View\Helper\AbstractHelper;
use Gc\Registry;

/**
 * Generate url with specific base path for cdn backend stored in database.
 *
 * @category   Gc_Library
 * @package    Library
 * @subpackage View\Helper
 * @example In view: $this->cdnBackend('path/to/file');
 */
class CdnBackend extends AbstractHelper
{
    /**
     * Base path
     *
     * @var string
     */
    protected $basePath = null;

    /**
     * Uri scheme
     *
     * @var string
     */
    protected $scheme;

    /**
     * Boolean meaning if the database exists
     *
     * @var boolean
     */
    protected $dbIsRegistered;

    /**
     * Constructor
     *
     * @param string  $scheme         Scheme
     * @param boolean $dbIsRegistered Db is registered
     *
     * @return void
     */
    public function __construct($scheme, $dbIsRegistered)
    {
        $this->scheme         = $scheme;
        $this->dbIsRegistered = $dbIsRegistered;
    }

    /**
     * Generates an url with the given path.
     *
     * @param string $path Path
     *
     * @return string  Url
     */
    public function __invoke($path)
    {
        if ($this->basePath === null) {
            $basePath = '';
            if ($this->dbIsRegistered) {
                if (CoreConfig::getValue('force_backend_ssl') or $this->scheme === 'https') {
                    $basePath = CoreConfig::getValue('secure_cdn_base_path');
                } else {
                    $basePath = CoreConfig::getValue('unsecure_cdn_base_path');
                }
            }

            $this->basePath = rtrim($basePath, '/');
        }

        return $this->basePath . '/' . ltrim($path, '/');
    }
}

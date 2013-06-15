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
 * @subpackage Datatype
 * @author     Pierre Rambaud (GoT) <pierre.rambaud86@gmail.com>
 * @license    GNU/LGPL http://www.gnu.org/licenses/lgpl-3.0.html
 * @link       http://www.got-cms.com
 */

namespace Gc\Datatype;

use Gc\Db\AbstractTable;
use Gc\Form\AbstractForm;
use Gc\Property\Model as PropertyModel;
use Datatypes;
use Zend\Form\Fieldset;
use Zend\View\HelperPluginManager;

/**
 * Datatype Model
 * Simply class to edit one datatype
 *
 * @category   Gc
 * @package    Library
 * @subpackage Datatype
 */
class Model extends AbstractTable
{
    /**
     * Table name
     *
     * @var string
     */
    protected $name = 'datatype';

    /**
     * Set prevalue value
     *
     * @param mixed $value Value
     *
     * @return \Gc\Datatype\Model
     */
    public function setPrevalueValue($value)
    {
        if (is_string($value)) {
            $value = unserialize($value);
        }

        $this->setData('prevalue_value', $value);

        return $this;
    }

    /**
     * Get Model from array
     *
     * @param array $array Data
     *
     * @return void
     */
    public static function fromArray(array $array)
    {
        $datatypeTable = new Model();
        $datatypeTable->setData($array);
        $datatypeTable->setOrigData();

        return $datatypeTable;
    }

    /**
     * Get model from id
     *
     * @param integer $datatypeId Datatype id
     *
     * @return false|\Gc\Datatype\Model
     */
    public static function fromId($datatypeId)
    {
        $datatypeTable = new Model();
        $row           = $datatypeTable->fetchRow($datatypeTable->select(array('id' => (int) $datatypeId)));
        if (!empty($row)) {
            $datatypeTable->setData((array) $row);
            $datatypeTable->setOrigData();
            return $datatypeTable;
        } else {
            return false;
        }
    }

    /**
     * Save Datatype model
     *
     * @return integer
     */
    public function save()
    {
        $this->events()->trigger(__CLASS__, 'beforeSave', null, array('object' => $this));
        $arraySave = array(
            'name' => $this->getName(),
            'prevalue_value' => serialize($this->getPrevalueValue()),
            'model' => $this->getModel(),
        );

        try {
            $id = $this->getId();
            if (empty($id)) {
                $this->insert($arraySave);
                $this->setId($this->getLastInsertId());
            } else {
                $this->update($arraySave, array('id' => $this->getId()));
            }

            $this->events()->trigger(__CLASS__, 'afterSave', null, array('object' => $this));

            return $this->getId();
        } catch (\Exception $e) {
            throw new \Gc\Exception($e->getMessage(), $e->getCode(), $e);
        }

        $this->events()->trigger(__CLASS__, 'afterSaveFailed', null, array('object' => $this));

        return false;
    }

    /**
     * Delete datatype model
     *
     * @return boolean
     */
    public function delete()
    {
        $this->events()->trigger(__CLASS__, 'beforeDelete', null, array('object' => $this));
        $id = $this->getId();
        if (!empty($id)) {
            try {
                parent::delete(array('id' => $id));
            } catch (\Exception $e) {
                throw new \Gc\Exception($e->getMessage(), $e->getCode(), $e);
            }

            $this->events()->trigger(__CLASS__, 'afterDelete', null, array('object' => $this));
            unset($this);

            return true;
        }

        $this->events()->trigger(__CLASS__, 'afterDeleteFailed', null, array('object' => $this));

        return false;
    }

    /**
     * Save prevalue editor
     *
     * @param AbstractDatatype $datatype Datatype
     *
     * @return Model
     */
    public static function savePrevalueEditor(AbstractDatatype $datatype)
    {
        $datatype->getPrevalueEditor()->save();
        return $datatype->getConfig();
    }

    /**
     * Save editor
     *
     * @param HelperPluginManager $viewHelperManager View Helper manager
     * @param PropertyModel       $property          Property
     *
     * @return mixed
     */
    public static function saveEditor(HelperPluginManager $viewHelperManager, PropertyModel $property)
    {
        $datatype = self::loadDatatype($viewHelperManager, $property->getDatatypeId(), $property->getDocumentId());
        $datatype->getEditor($property)->save();
        if (!$property->saveValue()) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Load prevalue editor
     *
     * @param AbstractDatatype $datatype Datatype
     *
     * @return mixed
     */
    public static function loadPrevalueEditor(AbstractDatatype $datatype)
    {
        $fieldset = new Fieldset('prevalue-editor');
        AbstractForm::addContent($fieldset, $datatype->getPrevalueEditor()->load());
        return $fieldset;
    }

    /**
     * Load editor
     *
     * @param HelperPluginManager $viewHelperManager View Helper manager
     * @param PropertyModel       $property          Property
     *
     * @return mixed
     */
    public static function loadEditor(HelperPluginManager $viewHelperManager, PropertyModel $property)
    {
        $datatype = self::loadDatatype($viewHelperManager, $property->getDatatypeId(), $property->getDocumentId());

        return $datatype->getEditor($property)->load();
    }

    /**
     * Load Datatype
     *
     * @param HelperPluginManager $viewHelperManager View Helper manager
     * @param integer             $datatypeId        Datatype id
     * @param integer             $documentId        Optional document id
     *
     * @return \Gc\Datatype\AbstractDatatype
     */
    public static function loadDatatype(HelperPluginManager $viewHelperManager, $datatypeId, $documentId = null)
    {
        $datatype = Model::fromId($datatypeId);
        $class    = 'Datatypes\\' . $datatype->getModel() . '\Datatype';

        $object = new $class();
        $object->load($viewHelperManager, $datatype, $documentId);
        return $object;
    }
}

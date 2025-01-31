<?php

namespace srag\Plugins\Hub2\UI;

use ilHub2Plugin;
use srag\DIC\Hub2\DICTrait;
use srag\Plugins\Hub2\Origin\AROrigin;
use srag\Plugins\Hub2\Utils\Hub2Trait;

/**
 * Class OriginFormFactory
 * @package srag\Plugins\Hub2\UI
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 */
class OriginFormFactory
{

    use DICTrait;
    use Hub2Trait;

    const PLUGIN_CLASS_NAME = ilHub2Plugin::class;

    /**
     * @param AROrigin $origin
     * @return string
     */
    public function getFormClassNameByOrigin(AROrigin $origin)
    {
        $type = $origin->getObjectType();

        $ucfirst = ucfirst($type);

        return "srag\\Plugins\\Hub2\\UI\\" . $ucfirst . "\\" . $ucfirst . "OriginConfigFormGUI";
    }
}

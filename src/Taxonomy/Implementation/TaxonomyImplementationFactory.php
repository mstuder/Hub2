<?php

namespace srag\Plugins\Hub2\Taxonomy\Implementation;

use ilHub2Plugin;
use ilObject;
use srag\DIC\Hub2\DICTrait;
use srag\Plugins\Hub2\Taxonomy\ITaxonomy;
use srag\Plugins\Hub2\Utils\Hub2Trait;

/**
 * Class ITaxonomyImplementationFactory
 * @package srag\Plugins\Hub2\Taxonomy\Implementation
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 */
class TaxonomyImplementationFactory implements ITaxonomyImplementationFactory
{

    use DICTrait;
    use Hub2Trait;

    const PLUGIN_CLASS_NAME = ilHub2Plugin::class;

    /**
     * @inheritdoc
     */
    public function taxonomy(ITaxonomy $Taxonomy, ilObject $ilias_object) : ITaxonomyImplementation
    {
        switch ($Taxonomy->getMode()) {
            case ITaxonomy::MODE_CREATE:
                return new TaxonomyCreate($Taxonomy, (int) $ilias_object->getRefId());
            case ITaxonomy::MODE_SELECT:
                return new TaxonomySelect($Taxonomy, (int) $ilias_object->getRefId());
        }

        return null;
    }
}

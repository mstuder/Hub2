<?php

namespace srag\CustomInputGUIs\Hub2\FormBuilder;

use ILIAS\UI\Component\Input\Container\Form\Form;

/**
 * Interface FormBuilder
 *
 * @package srag\CustomInputGUIs\Hub2\FormBuilder
 *
 * @author  studer + raimann ag - Team Custom 1 <support-custom1@studer-raimann.ch>
 */
interface FormBuilder
{

    /**
     * @return Form
     */
    public function getForm() : Form;


    /**
     * @return string
     */
    public function render() : string;


    /**
     * @return bool
     */
    public function storeForm() : bool;
}

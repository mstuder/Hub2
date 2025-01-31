<?php

namespace srag\Plugins\Hub2\UI\Config;

use hub2ConfigGUI;
use hub2LogsGUI;
use ilCheckboxInputGUI;
use ilFormPropertyGUI;
use ilFormSectionHeaderGUI;
use ilHub2ConfigGUI;
use ilHub2Plugin;
use ilNumberInputGUI;
use ilPropertyFormGUI;
use ilTextAreaInputGUI;
use ilTextInputGUI;
use srag\DIC\Hub2\DICTrait;
use srag\Plugins\Hub2\Config\ArConfig;
use srag\Plugins\Hub2\Utils\Hub2Trait;

/**
 * Class ConfigFormGUI
 * @package srag\Plugins\Hub2\UI\Config
 * @author  Stefan Wanzenried <sw@studer-raimann.ch>
 * @author  Fabian Schmid <fs@studer-raimann.ch>
 */
class ConfigFormGUI extends ilPropertyFormGUI
{

    use DICTrait;
    use Hub2Trait;

    const PLUGIN_CLASS_NAME = ilHub2Plugin::class;
    /**
     * @var ilHub2ConfigGUI
     */
    protected $parent_gui;

    /**
     * ConfigFormGUI constructor
     * @param hub2ConfigGUI $parent_gui
     */
    public function __construct(hub2ConfigGUI $parent_gui)
    {
        parent::__construct();

        $this->parent_gui = $parent_gui;

        $this->initForm();
    }

    /**
     *
     */
    protected function initForm()/*: void*/
    {
        $this->setFormAction(self::dic()->ctrl()->getFormAction($this->parent_gui));

        $this->addCommandButton(hub2ConfigGUI::CMD_SAVE_CONFIG, self::plugin()->translate('button_save'));
        $this->addCommandButton(hub2ConfigGUI::CMD_CANCEL, self::plugin()->translate('button_cancel'));

        $this->setTitle(self::plugin()->translate('admin_form_title'));

        $item = new ilTextInputGUI(self::plugin()->translate('admin_origins_path'),
            ArConfig::KEY_ORIGIN_IMPLEMENTATION_PATH);
        $item->setInfo(self::plugin()->translate('admin_origins_path_info'));
        $item->setValue(ArConfig::getField(ArConfig::KEY_ORIGIN_IMPLEMENTATION_PATH));
        $this->addItem($item);

        $cb = new ilCheckboxInputGUI(self::plugin()->translate('admin_lock'), ArConfig::KEY_LOCK_ORIGINS_CONFIG);
        $cb->setChecked(ArConfig::getField(ArConfig::KEY_LOCK_ORIGINS_CONFIG));
        $this->addItem($cb);

        $cb = new ilCheckboxInputGUI(self::plugin()->translate('admin_msg_' . ArConfig::KEY_GLOBAL_HOCK_ACTIVE),
            ArConfig::KEY_GLOBAL_HOCK_ACTIVE);
        $cb->setChecked(ArConfig::getField(ArConfig::KEY_GLOBAL_HOCK_ACTIVE));
        $sub_item = new ilTextInputGUI(self::plugin()->translate('admin_msg_' . ArConfig::KEY_GLOBAL_HOCK_PATH),
            ArConfig::KEY_GLOBAL_HOCK_PATH);
        $sub_item->setValue(ArConfig::getField(ArConfig::KEY_GLOBAL_HOCK_PATH));
        $sub_item->setInfo(self::plugin()->translate('admin_msg_' . ArConfig::KEY_GLOBAL_HOCK_PATH . '_info'));
        $cb->addSubItem($sub_item);
        $sub_item = new ilTextInputGUI(self::plugin()->translate('admin_msg_' . ArConfig::KEY_GLOBAL_HOCK_CLASS),
            ArConfig::KEY_GLOBAL_HOCK_CLASS);
        $sub_item->setValue(ArConfig::getField(ArConfig::KEY_GLOBAL_HOCK_CLASS));
        $sub_item->setInfo(self::plugin()->translate('admin_msg_' . ArConfig::KEY_GLOBAL_HOCK_CLASS . '_info'));
        $cb->addSubItem($sub_item);
        $this->addItem($cb);

        $item = new ilFormSectionHeaderGUI();
        $item->setTitle(self::plugin()->translate("logs", hub2LogsGUI::LANG_MODULE_LOGS));
        $this->addItem($item);

        $item = new ilNumberInputGUI(
            self::plugin()
                ->translate(ArConfig::KEY_KEEP_OLD_LOGS_TIME, hub2LogsGUI::LANG_MODULE_LOGS),
            ArConfig::KEY_KEEP_OLD_LOGS_TIME
        );
        $item->setSuffix(self::plugin()->translate("days", hub2LogsGUI::LANG_MODULE_LOGS));
        $item->setInfo(self::plugin()->translate(ArConfig::KEY_KEEP_OLD_LOGS_TIME . "_info",
            hub2LogsGUI::LANG_MODULE_LOGS));
        $item->setMinValue(0);
        $item->setValue(ArConfig::getField(ArConfig::KEY_KEEP_OLD_LOGS_TIME));
        $this->addItem($item);

        $item = new ilFormSectionHeaderGUI();
        $item->setTitle(self::plugin()->translate('common_permissions'));
        $this->addItem($item);

        $item = new ilTextInputGUI(self::plugin()->translate('common_roles'), ArConfig::KEY_ADMINISTRATE_HUB_ROLE_IDS);
        $item->setValue(implode(', ',
            ArConfig::getField(ArConfig::KEY_ADMINISTRATE_HUB_ROLE_IDS))); // TODO: Use better config gui for getAdministrationRoleIds
        $item->setInfo(self::plugin()->translate('admin_roles_info'));
        $this->addItem($item);

        $h = new ilFormSectionHeaderGUI();
        $h->setTitle(self::plugin()->translate('admin_shortlink'));
        $this->addItem($h);

        $item = new ilTextAreaInputGUI(
            self::plugin()->translate(
                'admin_msg_'
                . ArConfig::KEY_SHORTLINK_OBJECT_NOT_FOUND
            ), ArConfig::KEY_SHORTLINK_OBJECT_NOT_FOUND
        );
        $item->setUseRte(false);
        $item->setValue(ArConfig::getField(ArConfig::KEY_SHORTLINK_OBJECT_NOT_FOUND));
        $item->setInfo(self::plugin()->translate('admin_msg_' . ArConfig::KEY_SHORTLINK_OBJECT_NOT_FOUND . '_info'));
        $this->addItem($item);

        $item = new ilTextAreaInputGUI(
            self::plugin()->translate(
                'admin_msg_'
                . ArConfig::KEY_SHORTLINK_OBJECT_NOT_ACCESSIBLE
            ), ArConfig::KEY_SHORTLINK_OBJECT_NOT_ACCESSIBLE
        );
        $item->setUseRte(false);
        $item->setValue(ArConfig::getField(ArConfig::KEY_SHORTLINK_OBJECT_NOT_ACCESSIBLE));
        $item->setInfo(self::plugin()->translate('admin_msg_' . ArConfig::KEY_SHORTLINK_OBJECT_NOT_ACCESSIBLE . '_info'));
        $this->addItem($item);

        $item = new ilTextAreaInputGUI(self::plugin()->translate('admin_msg_' . ArConfig::KEY_SHORTLINK_SUCCESS),
            ArConfig::KEY_SHORTLINK_SUCCESS);
        $item->setUseRte(false);
        $item->setValue(ArConfig::getField(ArConfig::KEY_SHORTLINK_SUCCESS));
        $item->setInfo(self::plugin()->translate('admin_msg_' . ArConfig::KEY_SHORTLINK_SUCCESS . '_info'));
        $this->addItem($item);

        $h = new ilFormSectionHeaderGUI();
        $h->setTitle(self::plugin()->translate('views'));
        $this->addItem($h);

        $cb = new ilCheckboxInputGUI(self::plugin()->translate('admin_msg_' . ArConfig::KEY_CUSTOM_VIEWS_ACTIVE),
            ArConfig::KEY_CUSTOM_VIEWS_ACTIVE);
        $cb->setChecked(ArConfig::getField(ArConfig::KEY_CUSTOM_VIEWS_ACTIVE));
        $sub_item = new ilTextInputGUI(self::plugin()->translate('admin_msg_' . ArConfig::KEY_CUSTOM_VIEWS_PATH),
            ArConfig::KEY_CUSTOM_VIEWS_PATH);
        $sub_item->setValue(ArConfig::getField(ArConfig::KEY_CUSTOM_VIEWS_PATH));
        $sub_item->setInfo(self::plugin()->translate('admin_msg_' . ArConfig::KEY_CUSTOM_VIEWS_PATH . '_info'));
        $cb->addSubItem($sub_item);
        $sub_item = new ilTextInputGUI(self::plugin()->translate('admin_msg_' . ArConfig::KEY_CUSTOM_VIEWS_CLASS),
            ArConfig::KEY_CUSTOM_VIEWS_CLASS);
        $sub_item->setValue(ArConfig::getField(ArConfig::KEY_CUSTOM_VIEWS_CLASS));
        $sub_item->setInfo(self::plugin()->translate('admin_msg_' . ArConfig::KEY_CUSTOM_VIEWS_CLASS . '_info'));
        $cb->addSubItem($sub_item);
        $this->addItem($cb);

        //		$h = new ilFormSectionHeaderGUI();
        //		$h->setTitle(self::plugin()->translate('admin_membership'));
        //		$this->addItem($h);
        //
        //		$cb = new ilCheckboxInputGUI(self::plugin()->translate('admin_membership_activate'), ArConfig::KEY_MMAIL_ACTIVE);
        //		$cb->setInfo(self::plugin()->translate('admin_membership_activate_info'));
        //		$this->addItem($cb);
        //
        //		$mm = new ilTextInputGUI(self::plugin()->translate('admin_membership_mail_subject'), ArConfig::KEY_MMAIL_SUBJECT);
        //		$mm->setInfo(self::plugin()->translate('admin_membership_mail_subject_info'));
        //		$this->addItem($mm);
        //
        //		$mm = new ilTextAreaInputGUI(self::plugin()->translate('admin_membership_mail_msg'), ArConfig::KEY_MMAIL_MSG);
        //		$mm->setInfo(nl2br(str_replace("\\n", "\n", self::plugin()->translate('admin_membership_mail_msg_info')), false));
        //		$this->addItem($mm);
        //
        //		$h = new ilFormSectionHeaderGUI();
        //		$h->setTitle(self::plugin()->translate('admin_user_creation'));
        //		$this->addItem($h);
        //
        //		$ti = new ilTextInputGUI(self::plugin()->translate('admin_user_creation_standard_role'), ArConfig::KEY_STANDARD_ROLE);
        //		$this->addItem($ti);
        //
        //		$h = new ilFormSectionHeaderGUI();
        //		$h->setTitle(self::plugin()->translate('admin_header_sync'));
        //		$this->addItem($h);
        //
        //		$cb = new ilCheckboxInputGUI(self::plugin()->translate('admin_use_async'), ArConfig::KEY_USE_ASYNC);
        //		$cb->setInfo(self::plugin()->translate('admin_use_async_info'));
        //
        //		$te = new ilTextInputGUI(self::plugin()->translate('admin_async_user'), ArConfig::KEY_ASYNC_USER);
        //		$cb->addSubItem($te);
        //		$te = new ilTextInputGUI(self::plugin()->translate('admin_async_password'), ArConfig::KEY_ASYNC_PASSWORD);
        //		$cb->addSubItem($te);
        //		$te = new ilTextInputGUI(self::plugin()->translate('admin_async_client'), ArConfig::KEY_ASYNC_CLIENT);
        //		$cb->addSubItem($te);
        //		$te = new ilTextInputGUI(self::plugin()->translate('admin_async_cli_php'), ArConfig::KEY_ASYNC_CLI_PHP);
        //		$cb->addSubItem($te);
        //		$this->addItem($cb);

        //		$cb = new ilCheckboxInputGUI(self::plugin()->translate('admin_import_export'), ArConfig::KEY_IMPORT_EXPORT);
        //		$this->addItem($cb);
    }

    /**
     *
     */
    public function updateConfig()/*: void*/
    {
        foreach ($this->getInputItemsRecursive() as $item) {
            /** @var ilFormPropertyGUI $item */
            switch ($item->getPostVar()) {
                case ArConfig::KEY_ADMINISTRATE_HUB_ROLE_IDS:
                    $administration_role_ids = $this->getInput($item->getPostVar());
                    $administration_role_ids = preg_split('/, */', $administration_role_ids);
                    $administration_role_ids = array_map(
                        function (string $id) : int {
                            return intval($id);
                        }, $administration_role_ids
                    );
                    ArConfig::setField($item->getPostVar(),
                        $administration_role_ids); // TODO: Use better config gui for getAdministrationRoleIds
                    break;
                default:
                    ArConfig::setField($item->getPostVar(), $this->getInput($item->getPostVar()));
                    break;
            }
        }
    }
}

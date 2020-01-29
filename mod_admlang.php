<?php

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;

JLoader::register('ModAdmLangHelper', __DIR__ . '/helper.php');

require ModuleHelper::getLayoutPath('mod_admlang', $params->get('layout', 'default'));

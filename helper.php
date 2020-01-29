<?php

defined('_JEXEC') or die;

use Joomla\CMS\
{
	Factory,
	Session\Session
};

class ModAdmlangHelper
{

	public static function changeAjax()
	{
		if (Session::checkToken('get') === false)
		{
			throw new Exception('Error token');
		}

		$lang = Factory::getApplication()->input->getString('lang');
		if (empty($lang))
		{
			throw new Exception('Empty language code');
		}

		$user = Factory::getUser();
		$user->setParam('admin_language', $lang);

		return $user->save();
	}

}

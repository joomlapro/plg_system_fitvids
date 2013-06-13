<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.Fitvids
 *
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('_JEXEC') or die;

/**
 * Joomla Fitvids plugin.
 *
 * @package     Joomla.Plugin
 * @subpackage  System.Fitvids
 * @since       3.1
 */
class PlgSystemFitvids extends JPlugin
{
	/**
	 * Method to catch the onAfterDispatch event.
	 *
	 * @return  boolean  True on success.
	 *
	 * @since   3.1
	 */
	public function onAfterDispatch()
	{
		// Check that we are in the site application.
		if (JFactory::getApplication()->isAdmin())
		{
			return true;
		}

		// Add JavaScript Frameworks.
		JHtml::_('jquery.framework');

		// Load JavaScript.
		if ($this->params->get('minified', 1))
		{
			JHtml::script('plg_system_fitvids/jquery.fitvids.min.js', false, true);
		}
		else
		{
			JHtml::script('plg_system_fitvids/jquery.fitvids.js', false, true);
		}

		// Get the document object.
		$doc = JFactory::getDocument();

		// Build the script.
		$script = array();
		$script[] = 'jQuery(document).ready(function($) {';
		$script[] = '	$(\'' . $this->params->get('selector', '.video') . '\').fitVids();';
		$script[] = '});';

		// Add the script to the document head.
		$doc->addScriptDeclaration(implode("\n", $script));

		return true;
	}
}

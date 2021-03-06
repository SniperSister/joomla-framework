<?php
/**
 * Bootstrap file for the Joomla Framework.  This file becomes the PHAR stub when the platform is built
 * into a single deployable archive to be used in Joomla applications.
 *
 * @copyright  Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license    GNU General Public License version 2 or later; see LICENSE
 */

// Setup the Pharsanity!
Phar::interceptFileFuncs();

// Set the platform root path as a constant if necessary.
if (!defined('JPATH_PLATFORM'))
{
	define('JPATH_PLATFORM', 'phar://' . __FILE__);
}

// Import the platform version library if necessary.
if (!class_exists('JPlatform'))
{
	require_once JPATH_PLATFORM . '/platform.php';
}

// Import the library loader if necessary.
if (!class_exists('JLoader'))
{
	require_once JPATH_PLATFORM . '/loader.php';
}

// Make sure that the Joomla Framework has been successfully loaded.
if (!class_exists('JLoader'))
{
	throw new RuntimeException('Joomla Framework not loaded.');
}

// Setup the autoloaders.
JLoader::setup();

// Import the base Joomla Framework libraries.
JLoader::import('joomla.factory');

// Register classes for compatability with PHP 5.3
if (version_compare(PHP_VERSION, '5.4.0', '<'))
{
	JLoader::register('JsonSerializable', JPATH_PLATFORM . '/compat/jsonserializable.php');
}

// Register classes that don't follow one file per class naming conventions.
JLoader::register('JText', JPATH_PLATFORM . '/joomla/language/text.php');
JLoader::register('JRoute', JPATH_PLATFORM . '/joomla/application/route.php');

// End of the Phar Stub.
__HALT_COMPILER();?>

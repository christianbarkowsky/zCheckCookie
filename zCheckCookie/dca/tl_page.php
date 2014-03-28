<?php

/**
 * zCheckCookie
 * 
 * Copyright (C) 2014 Scyfel (Christian Barkowsky & Jan Theofel)
 * Copyright (C) 2011-2013 Jan Theofel <contao@theofel.com>
 * Copyright (C) ETES GmbH 2010
 * 
 * @package zCheckCookie
 * @author  Christian Barkowsky <http://christianbarkowsky.de>
 * @author  Jan Theofel <contao@theofel.com>
 * @author  Marc Schneider <marc.schneider@etes.de>
 * @link    http://scyfel.de
 * @license LGPL
 */


$GLOBALS['TL_DCA']['tl_page']['palettes']['__selector__'][] = 'includeCheckCookie';
$GLOBALS['TL_DCA']['tl_page']['subpalettes']['includeCheckCookie'] = 'cCredirectIfExist,cCCookieName,cCCookieValue,cCJumpTo';

$GLOBALS['TL_DCA']['tl_page']['palettes']['regular'] = str_replace('{protected_legend:hide}', '{protected_legend:hide},includeCheckCookie', $GLOBALS['TL_DCA']['tl_page']['palettes']['regular']);


/**
 * Fields
 */
$GLOBALS['TL_DCA']['tl_page']['fields']['includeCheckCookie'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_page']['includeCheckCookie'],
	'exclude'           => true,
	'inputType'			=> 'checkbox',
	'eval'				=> array('submitOnChange'=>true),
	'sql'               => "char(1) NOT NULL default '0'"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cCredirectIfExist'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_page']['cCredirectIfExist'],
	'exclude'           => true,
	'inputType'			=> 'checkbox',
	'sql'               => "char(1) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cCCookieName'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_page']['cCCookieName'],
	'exclude'            => true,
	'inputType'			=> 'text',
	'eval'				=> array('mandatory'=>true,'maxlength'=>255,'tl_class'=>'w50'),
	'sql'               => "varchar(255) NOT NULL default ''"
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cCJumpTo'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_page']['cCJumpTo'],
	'exclude'           => true,
	'inputType'         => 'pageTree',
	'foreignKey'        => 'tl_page.title',
	'eval'              => array('fieldType'=>'radio', 'mandatory'=>true),
	'sql'               => "int(10) unsigned NOT NULL default '0'",
	'relation'          => array('type'=>'hasOne', 'load'=>'eager')
	
);

$GLOBALS['TL_DCA']['tl_page']['fields']['cCCookieValue'] = array
(
	'label'				=> &$GLOBALS['TL_LANG']['tl_page']['cCCookieValue'],
	'exclude'           => true,
	'inputType'			=> 'text',
	'eval'				=> array('mandatory'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
	'sql'               => "varchar(255) NOT NULL default ''"
);

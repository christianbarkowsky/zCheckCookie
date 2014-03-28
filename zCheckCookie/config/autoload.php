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


\Contao\ClassLoader::addNamespace('Scyfel');


ClassLoader::addClasses(array
(
	'Scyfel\CheckCookie' => 'system/modules/zCheckCookie/classes/CheckCookie.php',
));

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

namespace Scyfel;


class CheckCookie extends \Backend
{

	//public function generatePage(Database_Result $objPage, Database_Result $objLayout, PageRegular $objPageRegular)
	public function generatePage(\PageModel $objPage, \LayoutModel $objLayout, \PageRegular $objPageRegular)
	{
		$objDatabase = \Database::getInstance();
		
		// check if this page is proteced
		if($objPage->includeCheckCookie)
		{
			$checkCookieExists = $objPage->cCredirectIfExist;
			$checkCookieName   = $objPage->cCCookieName;
			$checkCookieValue  = $objPage->cCCookieValue;
			$checkCookieTarget = $objPage->cCJumpTo;
		}
		else
		{
			// check if parents are proteced, using extension parentslist
			$parents = $objDatabase->execute("SELECT includeCheckCookie, cCredirectIfExist, cCCookieName, cCCookieValue, cCJumpTo, field(id," . $objPage->parents . ") AS mysort FROM tl_page WHERE id IN (" . $objPage->parents . ") ORDER BY mysort;");

			if ($parents->numRows > 0)
			{
				while($parents->next())
				{
					if($parents->includeCheckCookie)
					{
						$checkCookieExists = $parents->cCredirectIfExist;
						$checkCookieName   = $parents->cCCookieName;
						$checkCookieValue  = $parents->cCCookieValue;
						$checkCookieTarget = $parents->cCJumpTo;
					}
				}
			}
		}

		// we have to check for a cookie
		if($checkCookieName != '')
		{
			// does cookie exist?
			$checkValue = \Input::cookie($checkCookieName);
			$cookieExists = (isset($checkValue) && ($checkValue == $checkCookieValue)) ? 1 : 0;

			// check if we need to redirect with XOR which equals ($checkCookieExists && !$cookieExists) || (!$checkCookieExists && $cookieExists)
			if (!($checkCookieExists xor $cookieExists))
			{
				// Set current page id in cookie
				$this->setCookie('ZCHECKCOOKIE_PAGEID', $objPage->id, time() + 84400);
			
				$myPageObj = $objDatabase->prepare("SELECT * FROM tl_page WHERE id=?")->execute($checkCookieTarget);
				$this->redirect($this->generateFrontendUrl($myPageObj->row()));
			}
		}
	}
}

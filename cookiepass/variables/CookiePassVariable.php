<?php
namespace Craft;

class CookiePassVariable
{

/* --------------------------------------------------------------------------------
	Variables
-------------------------------------------------------------------------------- */

	function hasCookiePass()
	{
		return craft()->cookiePass_utils->hasCookiePass();
	}

}
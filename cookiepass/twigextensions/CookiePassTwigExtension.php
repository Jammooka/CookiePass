<?php 
namespace Craft;

use Twig_Extension;
use Twig_Filter_Method;

class CookiePassTwigExtension extends \Twig_Extension
{

/* --------------------------------------------------------------------------------
	Expose our filters and functions
-------------------------------------------------------------------------------- */

	public function getName()
	{
		return 'Cookie Pass';
	}

// -- Return our twig filters

	public function getFilters()
	{
		return array(
			'hasCookiePass' => new \Twig_Filter_Method($this, 'hasCookiePass_filter'),
		);
	}

// -- Return our twig functions

	public function getFunctions()
	{
		return array(
			'hasCookiePass' => new \Twig_Function_Method($this, 'hasCookiePass_filter'),
		);
	}

/* --------------------------------------------------------------------------------
	Filters
-------------------------------------------------------------------------------- */

	public function hasCookiePass_filter()
	{
		return craft()->cookiePass_utils->hasCookiePass();
	}

} /* -- CookiePassTwigExtension */

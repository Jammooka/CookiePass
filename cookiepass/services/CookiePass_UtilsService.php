<?php
namespace Craft;

class CookiePass_UtilsService extends BaseApplicationComponent
{

/* --------------------------------------------------------------------------------
	Security validated cookies
-------------------------------------------------------------------------------- */

	public function login($pass)
	{
		// Get password from settings
		$passToMatch = $cookie_name = craft()->plugins->getPlugin('cookiepass')->getSettings()->password;
		
		// Compare Pass to password in settings
		$matches = craft()->security->compareString($passToMatch, $pass);
		
		// Create the cookie if the password matches
		if($matches)
		{
			$this->setCookiePass();
		}
		return $matches;
	}

	public function logout()
	{
		$this->removeCookie();
	}

	public function hasCookiePass()
	{
		$cookie_name = craft()->plugins->getPlugin('cookiepass')->getSettings()->cookieName;
		$cookie = craft()->request->getCookie($cookie_name);
		
		return ($cookie !== NULL);
	}
	
	private function setCookiePass()
	{
		$cookie_name = craft()->plugins->getPlugin('cookiepass')->getSettings()->cookieName;
		$content = 'Logged into ' . craft()->getSiteName();
		$expire = (int) strtotime("+1 month");
		
		$cookie = new HttpCookie($cookie_name, '');
		$cookie->value = base64_encode($content);
		$cookie->expire = $expire;
		$cookie->path = '/'; // Available to entire domain
		
		craft()->request->getCookies()->add($cookie->name, $cookie);
	}
	
	private function removeCookie()
	{
		$cookie_name = craft()->plugins->getPlugin('cookiepass')->getSettings()->cookieName;
		$expire = (int) strtotime("-1 hour");
		
		$cookie = new HttpCookie($cookie_name, '');
		$cookie->value = '';
		$cookie->expire = $expire;
		$cookie->path = '/'; // Available to entire domain
		
		craft()->request->getCookies()->add($cookie->name, $cookie);
	}

} /* -- CookiePass_UtilsService */
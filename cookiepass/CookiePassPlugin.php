<?php
namespace Craft;

class CookiePassPlugin extends BasePlugin
{
	function getName()
	{
		return Craft::t('Cookie Pass');
	}

	function getVersion()
	{
		return '1.0.0';
	}

	function getDeveloper()
	{
		return 'Jamie Blacker';
	}

	function getDeveloperUrl()
	{
		return 'http://www.rubbertrumpet.com';
	}

	public function getPluginUrl()
	{
		return 'https://github.com/Jammooka/CookiePass';
	}

	public function getDocumentationUrl()
	{
		return $this->getPluginUrl();
	}

	public function addTwigExtension()
	{
		Craft::import('plugins.cookiepass.twigextensions.CookiePassTwigExtension');

		return new CookiePassTwigExtension();
	}
	
	protected function defineSettings()
	{
		return array(
			'password'		=>	array(
									AttributeType::String,
									'required' => true
								),
			'cookieName'		=>	array(
									AttributeType::String,
									'default' => 'CookiePass',
									'required' => true
								),
			'loginMsg'		=>	array(
									AttributeType::String,
									'default' => 'You have logged in',
									'required' => true
								),
			'logoutMsg'	=>	array(
									AttributeType::String,
									'default' => 'You have logged out',
									'required' => true
								),
		);
	}
	
	public function getSettingsHtml()
    {
        return craft()->templates->render('cookiepass/settings', array(
            'settings' => $this->getSettings()
        ));
    }
}

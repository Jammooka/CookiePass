<?php
namespace Craft;

class CookiePass_AuthController extends BaseController
{
	// Allow logged out users access to the controller
	protected $allowAnonymous = true;
	
	public function actionLogin()
	{
		$this->requirePostRequest();
		
		// Get params
		$pass = craft()->request->getPost('pass');
		
		// Call the login function
		$login = craft()->cookiePass_utils->login($pass);
		
		if($login)
		{
			// Get flash message text
			$msg = craft()->plugins->getPlugin('cookiepass')->getSettings()->loginMsg;
			// Set a flash message
			craft()->userSession->setFlash('notice', $msg);
		}
		else
		{
			// Set error flash message
			craft()->userSession->setFlash('error', 'Incorrect password');
		}
		
		// Return user to page to avoid 404
		$this->redirectToPostedUrl();
	}
	
	public function actionLogout()
	{
		// Get params
		$redirect = craft()->request->getParam('redirect');
		
		// Call the logout function
		craft()->cookiePass_utils->logout();
		
		// Get flash message text
		$msg = craft()->plugins->getPlugin('cookiepass')->getSettings()->logoutMsg;
		
		// Set a flash message
		craft()->userSession->setFlash('notice', $msg);
		
		// Return user to page to avoid 404
		$this->redirect($redirect);
	}
}
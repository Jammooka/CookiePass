## CookiePass plugin for Craft CMS

Provides a basic password only "login" that allows you to hide content from the general public. It's important to note that this is nothing like a member login. It's not going to be hard to break for anyone that knows how. Ultimately this is only protecting the pages from search engines and the average user.

It essentially just matches a plaintext string in the plugin settings and drops a cookie if the strings match.

### Installation

1. Unzip file 
2. Place `cookiepass` directory into your `craft/plugins` directory
3. Install plugin in the Craft Control Panel under Settings > Plugins

### Settings

**Password**: Plaintext string to match for your password
**Cookie Name**: The name of the cookie that is dropped
**Login Message**: The text for the 'notice' flash message upon successful login
**Logout Message**: The text for the 'notice' flash message upon successful logout

### Login
Simple form that just accepts a password.
You must have an 'action' field with the value set as the action URL.
You must pass a 'redirect' field with the value set to where you want to return to after login.
You must pass a 'pass' field with the user entered password as the value.

	<form method="post" action="" accept-charset="UTF-8">
		<input type="hidden" name="action" value="cookiePass/auth/login">
		<input type="hidden" name="redirect" value="/{{ craft.request.getPath() }}">
		
		<p>
			<label for="pass">Password</label>
			<input type="password" name="pass" id="pass" value="" />
		</p>
		
		<input type="submit" value="Login" />
	</form>

### Logout
Simply a link to the logout action URL. Accepts a redirect parameter

	<a href="{{ actionUrl('cookiePass/auth/logout', { redirect: '/' }) }}">Logout</a>

### Has CookiePass?
You can check whether or not the user as 'logged in' with this.

	{% if hasCookiePass() %}
		Logged in
	{% endif %}
	{% if not hasCookiePass() %}
		Not logged in
	{% endif %}

### Display logged in/out messages
This just uses the standard craft flash message tags. The success messages are 'notice' and the incorrect password error message is 'error'.
	
	{% set noticeFlash = craft.session.getFlash('notice') %}
	{% set errorFlash = craft.session.getFlash('error') %}
	{% if noticeFlash|length %}<div class="message success">{{ noticeFlash }}</div>{% endif %}
	{% if errorFlash|length %}<div class="message error">{{ errorFlash }}</div>{% endif %}

### Changelog

#### 1.0.0 -- 10/01/2016

* Initial release
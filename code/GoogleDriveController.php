<?php
class GoogleDriveController extends Controller {

	private static $url_segment = "googleconnector";

	private static $url_handlers = array(
		'$Action' => 'handleAction',
	);

	private static $allowed_actions = array(
		'response'
	);

	public function response(SS_HTTPRequest $request) {
		// get authentication parameters
		$clientId = OpauthAuthenticator::config()->opauth_settings['Strategy']['Google']['client_id'];
		$clientSecret = OpauthAuthenticator::config()->opauth_settings['Strategy']['Google']['client_secret'];
		// var_export(Director::absoluteBaseURL());

		// setup client
		$client = new Google_Client();
		$client->setClientId($clientId);
		$client->setClientSecret($clientSecret);
		$client->setRedirectUri(Director::absoluteBaseURL() . 'googleconnector/response');
		$client->setScopes(array(
			'https://www.googleapis.com/auth/drive'
		));

		$service = new Google_Service_Drive($client);

		// check auth code
		$authCode = $request->getVar('code');

		// if no code then authorise with google
		if(!$authCode) {
			$this->redirect($client->createAuthUrl());
		}

		// authenticate and get access token
		$accessToken = $client->authenticate($authCode);
		$client->setAccessToken($accessToken);


		// do all the things!!
		$file = $service->files->get('1le65zIVAQXo0y2vrKQyXExFmqr1egMaTXU5UtHVM7Xc');
		$link = $file->getExportLinks()['text/html'];

		echo "<p>Title: " . $file->getTitle() . '</p>';
		print "<p>Link: <a href='" . $link . "'>download HTML</a></p>";
	}

}
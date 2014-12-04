## Silverstripe - Google Drive Connector (WIP)

An experiment in importing Google Drive documents into the SilverStripe CMS to create pages.

## Requirements

* SilverStripe 3.1

## Installation

Requires a few modules that can be installed on your project via composer:

    composer require "silverstripe/external-content"
    composer require "google/apiclient"
    composer require "betterbrief/silverstripe-opauth"
    composer require "opauth/google"

## Configuration

In your `mysite/_config.php` file:
```
require_once('../vendor/google/apiclient/src/Google/Client.php');
require_once('../vendor/google/apiclient/src/Google/IO/Curl.php');
require_once('../vendor/google/apiclient/src/Google/Service/Drive.php');
```

In your `mysite/config/config.yml` file:
```
# ---
# Name: silverstripe-opauth
# After: 'framework/*','cms/*'
# ---
# see the Opauth docs for the config settings - https://github.com/opauth/opauth/wiki/Opauth-configuration#configuration-array
OpauthAuthenticator:
  opauth_settings:
    #Register your strategies here
    #Including any extra config
    Strategy:
      Google:
        client_id: '335118729113-62lcacqleb9e0jq9jiml8l9uh2vbsh3e.apps.googleusercontent.com'
        client_secret: 'IbzQChY3VXmUcsfKWXQqZYIf'
    security_salt: 'correct horse battery staple'
    security_iteration: 500
    security_timeout: '2 minutes'
    callback_transport: 'session'
#Configuration for the Identity-Member mapping
OpauthIdentity:
  member_mapper:
    Google:
      FirstName: 'info.first_name'
      Surname: 'info.last_name'
      Email: 'info.email'
      Locale: ['OpauthResponseHelper', 'get_google_locale']
```
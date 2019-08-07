# PHP 7 - Google Analytics Reporting Api v4 wrapper

## Table of Contents

 - Installation
 - Usage
 - Limitations
 - Testing
 - Support
 - License
 - FAQ

## Installation
**Requirements:** 
 - PHP ^7.0 (or higher)
 - Composer ^1.9.0
 - google/apiclient ^2.0
 - doctrine/collections ^1.4

**Installation**
Implementation in existing project with composer:

    $ composer require sherin/google-analytics

Or you can start from scratch:

    $ mkdir google-analytics-api
    $ cd google-analytics-api
    $ composer init
    $ composer require sherin/google-analytics

Its not recommended/not supported to use this package without composer. It won't be documented.

## Usage
This library is based on PHP 7.0 strict typing. Also we are using Doctrine's ArrayCollection because of the extra features. 

All the libraries classes are wrapped inside the namespace: `sherin\google\analytics\`

**Workflow:**
 1. Login to the Google api using the `Client` and `Credentials` classes.
 2. Determine what data you want and build the query using the `QueryBuilder`.
 3. If you have multiple queries, create a `Batch` object so the requests can be send in chunks of 5 (max allowed by Google).
 4. Collect the response from Google, its possible to get JSON data or use the PHP objects.

**Getting started**

> If you already know what Service Credentials are and you already own a json file, you can continue at step 2

1. First you need to obtain Service Credentials from Google from [THIS](https://console.developers.google.com/iam-admin/serviceaccounts) link. 
- Create a new project or use an existing project in the IAM and admin page. 
- Then create a new Service Account and enter a name you want (for example `WebsiteService` or `PHPService`)
- Give the service account the role "Viewer" or "Owner". Depends if you will use other Google Libraries (you can use this key for almost all google api's)
- When you're on *Step 3* click on the *[+ create key]* button and select the JSON type and click *[create]*. Now a JSON file will be downloaded and that's your credentials file that we need.
- After that, go to API's and services and open the Library. Search for "Google Analytics Reporting API" and enable the API for your account.
- For now its recommended to move the JSON array to your `.env` file because you should NEVER commit private keys to git. You can find an example [here](https://gist.github.com/SherinBloemendaal/41b4c5051cf39189b6ebee858b0f2a9c).
2. First we need to create a new `Credentials` class that contains your credentials. You can use the setters to setup your credentials or you can use the `setFromArray` function. The `setFromArray` function requires the following array setup:
```
$credentials = new Credentials();
$credentials->setFromArray($this->getGoogleCredentials());
```
And the `getGoogleCredentials()`function example:
```
private function getGoogleCredentials(): array
{
    return [  
        "type" => getenv("GOOGLE_TYPE"),  
        "project_id" => getenv("GOOGLE_TYPE"),  
        "private_key_id" => getenv('GOOGLE_PRIVATE_KEY_ID'),  
        "private_key" => str_replace('\n', PHP_EOL, getenv('GOOGLE_PRIVATE_KEY')),  //Dirty fix because older DotEnv versions does not support multi-lined variables. (since v3.0 but only supports php 7.2.
        "client_email" => getenv('GOOGLE_CLIENT_EMAIL'),  
        "client_id" => getenv('GOOGLE_CLIENT_ID'),  
        "auth_uri" => getenv("GOOGLE_AUTH_URI"),  
        "token_uri" => getenv("GOOGLE_TOKEN_URI"),  
        "auth_provider_x509_cert_url" => getenv("GOOGLE_AUTH_PROVIDER_CERT_URL"),  
        "client_x509_cert_url" => getenv('GOOGLE_CLIENT_CERT_URL')  
    ];
}
```
3. Now you have created the `Credentials` class with the required authentication tokens. Now we can start create a Client.
```
$client = new Client($credentials);
```
**The following is only required if you already have a class called** `Client`
You might have a duplicate declaration Client (if you use Guzzle for example). So instead of importing (`use`) the class. Call it from the namespace.
```
$client = new \sherin\google\analytics\Authentication\Client($credentials);
```

4. And finally, we create a instance of the `Analytics` api class so we can create requests to Google.
We need this instance later.
```
$analytics = new Analytics($client);
```
Or if you can't `use`/`import` the class, use the following:
```
$analytics = new \sherin\google\analytics\Analytics($client);
```

## Limitations
The currently limitations:
1. This library only supports *[Service Applications](https://console.developers.google.com/iam-admin/serviceaccounts)* (aka Server to Server) currently.
## Testing
Testing is not added yet!
*FYI: PHPUnit will be used for unit testing*
## Support
You can use the issue tracker of this project to create issues. Use stackoverflow for supporting issues. The issue tracker is only for bugs reports and feature requests. *(TODO  ISSUE_TEMPLATE.md)*
## Licence
This project is licensed under the Apache License - see the LICENSE.md file for details

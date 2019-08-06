<?php


namespace sherin\google\analytics\Authentication;

use Google_Service_Analytics;

class Client
{
    private $google_client;

    public function __construct(Credentials $credentials)
    {
        $config = [
            "type" => $credentials->getType(),
            "project_id" => $credentials->getProjectId(),
            "private_key_id" => $credentials->getPrivateKeyId(),
            "private_key" => $credentials->getPrivateKey(),
            "client_email" => $credentials->getClientEmail(),
            "client_id" => $credentials->getClientId(),
            "auth_uri" => $credentials->getAuthUri(),
            "token_uri" => $credentials->getTokenUri(),
            "auth_provider_x509_cert_url" => $credentials->getAuthProviderCertUrl(),
            "client_x509_cert_url" => $credentials->getClientCertUrl()
        ];
        $this->google_client = new \Google_Client($config);
        $this->google_client->addScope(Google_Service_Analytics::ANALYTICS_READONLY);

        $accessToken = $this->google_client->fetchAccessTokenWithAssertion()["access_token"];

        $this->google_client->setAccessToken($accessToken);
    }

    /**
     * @return \Google_Client
     */
    public function getGoogleClient(): \Google_Client
    {
        return $this->google_client;
    }

    /**
     * @param \Google_Client $google_client
     */
    public function setGoogleClient(\Google_Client $google_client)
    {
        $this->google_client = $google_client;
    }
}

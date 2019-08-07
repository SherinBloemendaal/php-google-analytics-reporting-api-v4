<?php

namespace sherin\google\analytics\Authentication;

use Exception;

/**
 * Class Credentials
 * @package Authentication
 */
class Credentials
{
    private $type;

    private $projectId;

    private $privateKeyId;

    private $privateKey;

    private $clientEmail;

    private $clientId;

    private $authUri;

    private $tokenUri;

    private $authProviderCertUrl;

    private $clientCertUrl;

    /**
     * Credentials constructor.
     * @param String $type
     * @param String $projectId
     * @param String $privateKeyId
     * @param String $privateKey
     * @param String $clientEmail
     * @param String $clientId
     * @param String $authUri
     * @param String $tokenUri
     * @param String $authProviderCertUrl
     * @param String $clientCertUrl
     */
    public function __construct(String $type = "", String $projectId = "", String $privateKeyId = "", String $privateKey = "", String $clientEmail = "", String $clientId = "", String $authUri = "", String $tokenUri = "", String $authProviderCertUrl = "", String $clientCertUrl = "")
    {
        $this->type = $type;
        $this->projectId = $projectId;
        $this->privateKeyId = $privateKeyId;
        $this->privateKey = $privateKey;
        $this->clientEmail = $clientEmail;
        $this->clientId = $clientId;
        $this->authUri = $authUri;
        $this->tokenUri = $tokenUri;
        $this->authProviderCertUrl = $authProviderCertUrl;
        $this->clientCertUrl = $clientCertUrl;
    }

    public function setFromArray(array $credentialsConfig)
    {
        $required = [
            "type",
            "project_id",
            "private_key_id",
            "private_key",
            "client_email",
            "client_id",
            "auth_uri",
            "token_uri",
            "auth_provider_x509_cert_url",
            "client_x509_cert_url",
        ];

        // Validate the given config with the required parameters (checks if given parameters are valid)
        foreach ($credentialsConfig as $key => $value) {
            if (!in_array($key, $required)) {
                throw new Exception("Unknown array key {$key} used in the config, remove it.");
            }
        }

        // Checks if the required parameters are inside the credentials config
        foreach ($required as $requiredKey) {
            //If the config contains unknown
            if (!array_key_exists($requiredKey, $credentialsConfig)) {
                throw new Exception("Missing array key {$requiredKey} in Credentials->setFromArray() function");
            }
        }

        $this->type = $credentialsConfig["type"];
        $this->projectId = $credentialsConfig["project_id"];
        $this->privateKeyId = $credentialsConfig["private_key_id"];
        $this->privateKey = $credentialsConfig["private_key"];
        $this->clientEmail = $credentialsConfig["client_email"];
        $this->clientId = $credentialsConfig["client_id"];
        $this->authUri = $credentialsConfig["auth_uri"];
        $this->tokenUri = $credentialsConfig["token_uri"];
        $this->authProviderCertUrl = $credentialsConfig["auth_provider_x509_cert_url"];
        $this->clientCertUrl = $credentialsConfig["client_x509_cert_url"];
    }

    /**
     * @return String
     */
    public function getType(): String
    {
        return $this->type;
    }

    /**
     * @param String $type
     */
    public function setType(String $type)
    {
        $this->type = $type;
    }

    /**
     * @return String
     */
    public function getProjectId(): String
    {
        return $this->projectId;
    }

    /**
     * @param String $projectId
     */
    public function setProjectId(String $projectId)
    {
        $this->projectId = $projectId;
    }

    /**
     * @return String
     */
    public function getPrivateKeyId(): String
    {
        return $this->privateKeyId;
    }

    /**
     * @param String $privateKeyId
     */
    public function setPrivateKeyId(String $privateKeyId)
    {
        $this->privateKeyId = $privateKeyId;
    }

    /**
     * @return String
     */
    public function getPrivateKey(): String
    {
        return $this->privateKey;
    }

    /**
     * @param String $privateKey
     */
    public function setPrivateKey(String $privateKey)
    {
        $this->privateKey = $privateKey;
    }

    /**
     * @return String
     */
    public function getClientEmail(): String
    {
        return $this->clientEmail;
    }

    /**
     * @param String $clientEmail
     */
    public function setClientEmail(String $clientEmail)
    {
        $this->clientEmail = $clientEmail;
    }

    /**
     * @return String
     */
    public function getClientId(): String
    {
        return $this->clientId;
    }

    /**
     * @param String $clientId
     */
    public function setClientId(String $clientId)
    {
        $this->clientId = $clientId;
    }

    /**
     * @return String
     */
    public function getAuthUri(): String
    {
        return $this->authUri;
    }

    /**
     * @param String $authUri
     */
    public function setAuthUri(String $authUri)
    {
        $this->authUri = $authUri;
    }

    /**
     * @return String
     */
    public function getTokenUri(): String
    {
        return $this->tokenUri;
    }

    /**
     * @param String $tokenUri
     */
    public function setTokenUri(String $tokenUri)
    {
        $this->tokenUri = $tokenUri;
    }

    /**
     * @return String
     */
    public function getAuthProviderCertUrl(): String
    {
        return $this->authProviderCertUrl;
    }

    /**
     * @param String $authProviderCertUrl
     */
    public function setAuthProviderCertUrl(String $authProviderCertUrl)
    {
        $this->authProviderCertUrl = $authProviderCertUrl;
    }

    /**
     * @return String
     */
    public function getClientCertUrl(): String
    {
        return $this->clientCertUrl;
    }

    /**
     * @param String $clientCertUrl
     */
    public function setClientCertUrl(String $clientCertUrl)
    {
        $this->clientCertUrl = $clientCertUrl;
    }
}

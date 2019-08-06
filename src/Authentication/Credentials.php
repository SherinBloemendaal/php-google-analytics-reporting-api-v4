<?php

namespace Authentication;

/**
 * Class Credentials
 * @package Authentication
 */
class Credentials
{
    /**
     * @var
     */
    private $type;

    /**
     * @var
     */
    private $projectId;

    /**
     * @var
     */
    private $privateKeyId;

    /**
     * @var
     */
    private $privateKey;

    /**
     * @var
     */
    private $clientEmail;

    /**
     * @var
     */
    private $clientId;

    /**
     * @var
     */
    private $authUri;

    /**
     * @var
     */
    private $tokenUri;

    /**
     * @var
     */
    private $authProviderCertUrl;

    /**
     * @var
     */
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
    public function __construct(String $type, String $projectId, String $privateKeyId, String $privateKey, String $clientEmail, String $clientId, String $authUri, String $tokenUri, String $authProviderCertUrl, String $clientCertUrl)
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

<?php
/*
 * This code was auto generated by AfterShip SDK Generator.
 * Do not edit the class manually.
 */
namespace Tracking;

use Tracking\Exception\AfterShipError;
use Tracking\Exception\ErrorCode;

class Config
{
    /**
     * @var string AfterShip API key
     */
    private $apiKey;

    /**
     * @var string AfterShip API Authentication method. Allowed value: API_KEY , AES , RSA
     */
    private $authenticationType;

    /**
     * @var string AfterShip API secret for AES or RSA authentication method.
     */
    private $apiSecret;

    /**
     * @var string Custom API domain.
     */
    private $domain;

    /**
     * @var int Max request retry attempt counts
     */
    private $maxRetry;

    /**
     * @var int Max request timeout in milliseconds
     */
    private $timeout;

    /**
     * @var string User-defined user agent string
     */
    private $userAgent;

    /**
     * @var string Proxy server address in {username}:{password}@{hostname}:{port} format
     */
    private $proxy;

    const AUTHENTICATION_TYPE_API_KEY = 'API_KEY';
    const AUTHENTICATION_TYPE_AES = 'AES';
    const AUTHENTICATION_TYPE_RSA = 'RSA';

    const SDK_PREFIX = 'AFTERSHIP_TRACKING_SDK'; //TPL
    const DEFAULT_MAX_RETRY = 2;
    const DEFAULT_TIMEOUT = 10000;
    const DEFAULT_DOMAIN = 'https://api.aftership.com';

    /**
     * Config Priority: User Input > Environment Variable > Default Value
     * @param array $conf
     * @throws AfterShipError
     */
    public function __construct(array $conf)
    {
        // Init config via env variables or default values
        $this->apiKey = $this->getSDKEnv('API_KEY') ?: null;
        $this->authenticationType = $this->getSDKEnv('AUTHENTICATION_TYPE') ?: self::AUTHENTICATION_TYPE_API_KEY;
        $this->apiSecret = $this->getSDKEnv('API_SECRET') ?: null;
        $this->domain = $this->getSDKEnv('DOMAIN') ?: self::DEFAULT_DOMAIN;
        $this->maxRetry = $this->getSDKEnv('MAX_RETRY') ?: self::DEFAULT_MAX_RETRY;
        $this->timeout = $this->getSDKEnv('TIMEOUT') ?: self::DEFAULT_TIMEOUT;
        $this->userAgent = $this->getSDKEnv('USER_AGENT') ?: null;
        $this->proxy = $this->getSDKEnv('PROXY') ?: null;

        // Override config with user input
        if (array_key_exists('apiKey', $conf)) {
            $this->setApiKey($conf['apiKey']);
        }

        if (array_key_exists('authenticationType', $conf)) {
            $this->setAuthenticationType($conf['authenticationType']);
        }

        if (array_key_exists('apiSecret', $conf)) {
            $this->setApiSecret($conf['apiSecret']);
        }

        if (array_key_exists('domain', $conf)) {
            $this->setDomain(rtrim($conf['domain'], '/'));
        }

        if (array_key_exists('maxRetry', $conf)) {
            $this->setMaxRetry($conf['maxRetry']);
        }

        if (array_key_exists('timeout', $conf)) {
            $this->setTimeout($conf['timeout']);
        }

        if (array_key_exists('userAgent', $conf)) {
            $this->setUserAgent($conf['userAgent']);
        }

        if (array_key_exists('proxy', $conf)) {
            $this->setProxy($conf['proxy']);
        }

        $this->checkConfig();
    }

    /**
     * @throws AfterShipError
     */
    private function checkConfig()
    {
        if (empty($this->getApiKey())) {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_API_KEY, 'apiKey cannot be empty');
        }

        if (
            !in_array($this->getAuthenticationType(), [
                self::AUTHENTICATION_TYPE_API_KEY,
                self::AUTHENTICATION_TYPE_AES,
                self::AUTHENTICATION_TYPE_RSA,
            ])
        ) {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_OPTION, 'Invalid option: authenticationType should be one of API_KEY, AES, RSA');
        }

        if ($this->getAuthenticationType() === self::AUTHENTICATION_TYPE_AES || $this->getAuthenticationType() === self::AUTHENTICATION_TYPE_RSA) {
            if (empty($this->getApiSecret())) {
                throw ErrorCode::genLocalError(ErrorCode::INVALID_API_KEY, 'Invalid option: apiSecret cannot be empty');
            }
        }

        if ($this->getMaxRetry() < 0 || $this->getMaxRetry() > 10) {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_OPTION, 'Invalid option: maxRetry should be 0 - 10');
        }

        if (!$this->isValidHttpHostname($this->getDomain())) {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_OPTION, 'Invalid option: domain should be a valid http[s] hostname');
        }

        if ($this->getTimeout() < 0 || $this->getTimeout() > 30000) {
            throw ErrorCode::genLocalError(ErrorCode::INVALID_OPTION, 'Invalid option: timeout should be 0 - 30000');
        }
    }

    private function isValidHttpHostname($url): bool
    {
        // Check if the URL is valid
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            return false;
        }

        $parsedUrl = parse_url($url);

        // Check if the URL has a valid scheme and host
        if (isset($parsedUrl['scheme']) && isset($parsedUrl['host']) && !isset($parsedUrl['path'])) {
            if ($parsedUrl['scheme'] === 'http' || $parsedUrl['scheme'] === 'https') {
                // Check if the hostname is valid
                if (preg_match('/^[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9](\.[a-zA-Z]{2,})+$/', $parsedUrl['host'])) {
                    return true;
                }
            }
        }

        return false;
    }

    private function getSDKEnv($key)
    {
        return getenv(self::SDK_PREFIX . '_' . $key);
    }

    public function getApiKey(): string
    {
        return $this->apiKey;
    }

    public function setApiKey($apiKey): Config
    {
        $this->apiKey = $apiKey;
        return $this;
    }

    public function getAuthenticationType(): string
    {
        return $this->authenticationType;
    }

    public function setAuthenticationType($authenticationType): Config
    {
        $this->authenticationType = $authenticationType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getApiSecret()
    {
        return $this->apiSecret;
    }

    public function setApiSecret($apiSecret): Config
    {
        $this->apiSecret = $apiSecret;
        return $this;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function setDomain(string $domain): Config
    {
        $this->domain = $domain;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getMaxRetry()
    {
        return $this->maxRetry;
    }

    public function setMaxRetry(int $maxRetry): Config
    {
        $this->maxRetry = $maxRetry;
        return $this;
    }

    /**
     * @return int|null
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    public function setTimeout(int $timeout): Config
    {
        $this->timeout = $timeout;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

    public function setUserAgent(string $userAgent): Config
    {
        $this->userAgent = $userAgent;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getProxy()
    {
        return $this->proxy;
    }

    public function setProxy(string $proxy): Config
    {
        $this->proxy = $proxy;
        return $this;
    }
}

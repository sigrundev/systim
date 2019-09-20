<?php

namespace Systim\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Systim\Result\SystimResult;

class SystimClient
{
    /**
     * Client instance.
     *
     * @var Client
     */
    protected $client;

    /**
     * Method 'get' or 'post'
     *
     * @var string
     */
    protected $method;

    /**
     * Systim session token
     *
     * @var string
     */
    protected $token;

    /**
     * SystimClient constructor.
     *
     * @param string $company
     * @param string $method
     */
    public function __construct(string $company, string $method = 'get')
    {
        $this->client = new Client([
            'base_uri' => $this->getBaseUrl($company)
        ]);

        $this->method = $method;
    }

    /**
     * Get token
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * Perform login to Systim API.
     *
     * @param string $username
     * @param string $password
     * @return SystimClient
     * @throws GuzzleException
     */
    public function login(string $username, string $password): SystimClient
    {
        $result = $this->request([
            'act' => 'login',
            'login' => $username,
            'pass' => $password
        ]);

        $this->token = $result->getToken();

        return $this;
    }

    /**
     * Perform API call
     *
     * @param array $params
     * @return SystimResult
     * @throws GuzzleException
     */
    public function request(array $params): SystimResult
    {
        $result = (string) ($this->client->request($this->method, '/jsonAPI.php', [
            'query' => $params
        ])->getBody());

        return new SystimResult($result);
    }

    /**
     * Get Systim API base URL.
     *
     * @param string $company
     * @param bool $isHttps
     * @return string
     */
    protected function getBaseUrl(string $company, bool $isHttps = true): string
    {
        return
            ($isHttps ? 'https' : 'http')
            . '://'
            . $company
            . '.systim.pl';

    }
}
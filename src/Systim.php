<?php

namespace Systim;

use GuzzleHttp\Exception\GuzzleException;
use Systim\Clients\SystimClient;
use Systim\Clients\SystimGetClient;
use Systim\Contracts\Clients\SystimClientInterface;

class Systim
{
    /**
     * @var string
     */
    protected $token;

    /**
     * @var SystimClient
     */
    protected $client;

    /**
     *
     * Systim constructor.
     * @param string $company
     * @param string $method
     */
    public function __construct(string $company, string $method = 'get')
    {
        $this->client = new SystimClient($company, $method);
    }

    /**
     * @param $name
     * @param $arguments
     * @return mixed
     * @throws GuzzleException
     */
    public function __call($name, $arguments)
    {
        if(!is_a($this->client, SystimClient::class)) {
            throw new \Exception('Client not created');
        }

        if($name === 'doLogin') {
            $this->client->login($arguments[0], $arguments[1]);
            return $this;
        }

        $this->client->request($name, $arguments[0]);
        return $this;
    }

    /**
     * Perform login action.
     *
     * @param string $company
     * @param string $user
     * @param string $password
     * @param string $method
     * @return Systim
     */
    public static function login(string $company, string $user, string $password, string $method = 'get'): Systim
    {
        return (new Systim($company, $method))->doLogin($user, $password);
    }

    /**
     * Get session token.
     *
     * @return string
     */
    public function getToken(): string
    {
        return $this->client->getToken();
    }
}
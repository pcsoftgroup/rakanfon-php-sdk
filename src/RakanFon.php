<?php

namespace PCsoft\RakanFon;

use Illuminate\Support\Facades\Http as HttpClient;

class RakanFon
{
    use MakesHttpRequests, Actions\ManagesPayments, Actions\ManagesSubscribers;

    /**
     * The RakanFon username.
     *
     * @var string
     */
    protected $username;

    /**
     * The RakanFon password.
     *
     * @var string
     */
    protected $password;

    /**
     * The RakanFon token.
     *
     * @var string
     */
    protected $token;

    /**
     * The HTTP Client instance.
     *
     * @var \Illuminate\Support\Facades\Http
     */
    public $client;

    /**
     * Number of seconds a request is retried.
     *
     * @var int
     */
    public $timeout = 30;

    /**
     * Create a new RakanFon instance.
     *
     * @param  string|null  $apiKey
     * @param  \Illuminate\Support\Facades\Http|null  $client
     * @return void
     */
    public function __construct($username = null, $password = null, $token = null)
    {
        if (!is_null($username)) {
            $this->setUsername($username);
        }

        if (!is_null($password)) {
            $this->setPassword($password);
        }

        if (!is_null($token)) {
            $this->setToken($token);
        }
    }

    /**
     * Transform the items of the collection to the given class.
     *
     * @param  array  $collection
     * @param  string  $class
     * @param  array  $extraData
     * @return array
     */
    protected function transformCollection($collection, $class, $extraData = [])
    {
        return array_map(function ($data) use ($class, $extraData) {
            return new $class($data + $extraData, $this);
        }, $collection);
    }

    /**
     * Set the merchant username.
     *
     * @param  string $username
     * @return $this
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Set the merchant merchantpassword.
     *
     * @param  string $password
     * @return $this
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set the token.
     *
     * @param  string $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Set a new timeout.
     *
     * @param  int  $timeout
     * @return $this
     */
    public function setTimeout($timeout)
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Get the timeout.
     *
     * @return int
     */
    public function getTimeout()
    {
        return $this->timeout;
    }

    /**
     * Build RakanFon.
     *
     * @param  int  $port
     * @param  callable  $middleware
     * @return $this
     */
    public function build(int $port = 9099, callable $middleware = null)
    {
        assert($this->username, 'Make sure to setUsername before build');

        assert($this->password, 'Make sure to setPassword before build');

        assert($this->token, 'Make sure to setToken before build');

        $this->client = $this->client ?: HttpClient::baseUrl("http://rakan.rakanfon.com:{$port}/agentsservice.svc")
            ->withoutVerifying()
            ->withHeaders([
                'Accept' => 'text/xml; charset=utf-8',
                'Content-Type' => 'text/xml',
                'SOAPAction' => 'http://tempuri.org/IService/DoOperation',
            ]);

        if ($middleware) {
            $this->client->withMiddleware($middleware);
        }

        return $this;
    }
}

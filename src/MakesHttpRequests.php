<?php

namespace PCsoft\RakanFon;

use PCsoft\RakanFon\Contracts\Operation;
use PCsoft\RakanFon\Exceptions\TimeoutException;
use PCsoft\RakanFon\Resources\UserToken;

trait MakesHttpRequests
{
    /**
     * Make a GET request to RakanFon servers and return the response.
     *
     * @param  string  $uri
     * @param  \PCsoft\RakanFon\Contracts\Operation $operation
     * @return mixed
     */
    public function get(Operation $operation, $uri = '')
    {
        return $this->request('GET', $uri,  $operation);
    }

    /**
     * Make a POST request to RakanFon servers and return the response.
     *
     * @param  string  $uri
     * @param  \PCsoft\RakanFon\Contracts\Operation $operation
     * @param  string  $operation
     * @return mixed
     */
    public function post(Operation $operation, $uri = '')
    {
        return $this->request('POST', $uri,  $operation);
    }

    /**
     * Make a PUT request to RakanFon servers and return the response.
     *
     * @param  string  $uri
     * @param  \PCsoft\RakanFon\Contracts\Operation $operation
     * @param  string  $operation
     * @return mixed
     */
    public function put(Operation $operation, $uri = '')
    {
        return $this->request('PUT', $uri,  $operation);
    }

    /**
     * Make a DELETE request to RakanFon servers and return the response.
     *
     * @param  string  $uri
     * @param  \PCsoft\RakanFon\Contracts\Operation $operation
     * @param  string  $operation
     * @return mixed
     */
    public function delete(Operation $operation, $uri = '')
    {
        return $this->request('DELETE', $uri,  $operation);
    }

    /**
     * Make request to RakanFon servers and return the response.
     *
     * @param  string  $verb
     * @param  \PCsoft\RakanFon\Contracts\Operation $operation
     * @param  array  $payload
     * @param  array  $headers
     * @return mixed
     */
    protected function request($verb, $uri, Operation $operation)
    {
        $user_token = (new UserToken($this->password, $operation->getType(), $operation->getTrakingId()))->toMessage();
        $operation_token = $operation->toMessage();

        $response = $this->client->send($verb, $uri, [
            'body' => <<<XML
            <soapenv:Envelope 
                xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" 
                xmlns:tem="http://tempuri.org/">
                <soapenv:Header/>
                    <soapenv:Body>
                        <tem:DoOperation>
                            <tem:UserID>{$this->username}</tem:UserID>
                            <tem:UserToken>{$this->encrypDesEdeCbc(key:$this->token, message:$user_token)}</tem:UserToken>
                            <tem:OperationToken>{$this->encrypDesEdeCbc(key:$this->token, message:$operation_token)}</tem:OperationToken>
                        </tem:DoOperation>
                    </soapenv:Body>
            </soapenv:Envelope>
            XML,
        ]);

        $body = xml_to_array($response->body());

        // if (ErrorCode::contains($resultMessage = $response->json('ResultMessage', 0)) || ($response->json('ResultCode', 0) !== 1) || !$response->ok()) {
        //     throw new FailedActionException($resultMessage, $response->body());
        // }

        return $body;
    }

    /**
     * Retry the callback or fail after x seconds.
     *
     * @param  int  $timeout
     * @param  callable  $callback
     * @param  int  $sleep
     * @return mixed
     *
     * @throws \PCsoft\RakanFon\Exceptions\TimeoutException
     */
    public function retry($timeout, $callback, $sleep = 5)
    {
        $start = time();

        beginning:

        if ($output = $callback()) {
            return $output;
        }

        if (time() - $start < $timeout) {
            sleep($sleep);

            goto beginning;
        }

        throw new TimeoutException($this->requestId, $output);
    }

    private function encrypDesEdeCbc(string $key, string $message)
    {
        $method = 'des-ede-cbc';
        $byte = mb_convert_encoding($key, 'ASCII');
        $iv =  substr($byte, 0, 8);

        return base64_encode(openssl_encrypt($message, $method, $key, OPENSSL_RAW_DATA, $iv));
    }
}

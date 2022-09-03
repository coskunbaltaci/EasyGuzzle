<?php
namespace Coskun\EasyGuzzle\Model;

use GuzzleHttp\Client;
use GuzzleHttp\ClientFactory;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\ResponseFactory;
use Magento\Framework\Webapi\Rest\Request;
use Coskun\EasyGuzzle\Api\RequestRepositoryInterface;

class RequestRepository implements RequestRepositoryInterface
{

    /*
    * @var ClientFactory
    */
    private ClientFactory $clientFactory;

    /*
    * @var ResponseFactory
    */
    private ResponseFactory $responseFactory;

    /**
     * @param ClientFactory $clientFactory
     * @param ResponseFactory $responseFactory
     */
    public function __construct(
        ClientFactory $clientFactory,
        ResponseFactory $responseFactory
    ) {
        $this->clientFactory = $clientFactory;
        $this->responseFactory = $responseFactory;
    }

    public function doRequest($params = []) {
        $apiUrl = $params['connectionData']['apiUrl'];
        $method =  $this->getRequestMethod($params['connectionData']); // Request Method
        $body = [];
        // Headers info added "barear token, content type, etc"
        if(array_key_exists('connectionData', $params)) {
            $body['headers'] = $this->getHeader($params['connectionData']);
        }
        // For query parameters
        if(array_key_exists('query', $params)) {
            $body['query'] = $params['query'];
        }
        // Body parameters set
        if(array_key_exists('parameters', $params)) {
            $body['body'] = $this->generateBody($params['parameters']);
        }
        // Client created
        $client = $this->clientFactory->create([
            'config' => [
                'base_uri' => $apiUrl
            ]
        ]);
        try {
            $response = $client->request($method, $params['connectionData']['apiUrl'], $body);
        } catch (\Exception $exception) {
            /** @var Response $response */
            $response = $this->responseFactory->create([
                'status' => $exception->getCode(),
                'reason' => $exception->getMessage()
            ]);
        }
        return $response;
    }

    /**
    * @param $connectionData
    * @return string
    */
    private function getRequestMethod($connectionData) {
        if(array_key_exists('method', $connectionData)) {
            return $connectionData['method'];
        }
        return Request::HTTP_METHOD_GET;
    }

    /**
     * @param $parameters
     * @return array
     */
    private function generateBody($parameters) {
        return json_encode($parameters, JSON_UNESCAPED_UNICODE);
    }

    /**
     * @param $connectionData
     * @return string[]
     */
    private function getHeader($connectionData) {
        $header = [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json'
        ];
        if(array_key_exists('token', $connectionData)) {
            $header['Authorization'] = 'Bearer ' . $connectionData['token'];
        }
        return $header;
    }
}

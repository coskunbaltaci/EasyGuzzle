<?php
/*
 *
 *  * @author Coskun Baltaci
 *  * @copyright Copyright (c) 2022 "Coskun Baltaci"
 *
 */

namespace Coskun\EasyGuzzle\Controller\Example;


use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NotFoundException;
use Magento\Framework\Webapi\Rest\Request;
use Coskun\EasyGuzzle\Api\RequestRepositoryInterface;

class Example implements HttpGetActionInterface
{
    /**
     * @var RequestRepositoryInterface
     */
    protected RequestRepositoryInterface $requestRepository;

    /**
     * @param RequestRepositoryInterface $requestRepository
     */
    public function __construct(
        RequestRepositoryInterface $requestRepository
    )
    {
        $this->requestRepository = $requestRepository;
    }

    /**
     * Execute action based on request and return result
     *
     * @return ResultInterface|ResponseInterface
     * @throws NotFoundException
     */
    public function execute()
    {
        $params = [
            'connectionData' => [
                'apiUrl' => '{REQUEST_URL}',
                'token' => '{BEARER TOKEN}',
                'method' => Request::HTTP_METHOD_GET
            ],
            'query' => [
                'param1' => 'john',  
                'param2' => 'smith'  
            ],
            'parameters' => [
                'param1' => 'string',
                'param2' => 0
            ]
        ];
        $response = $this->requestRepository->doRequest($params);
        echo $response->getStatusCode();
        echo $response->getBody()->getContents();
    }
}
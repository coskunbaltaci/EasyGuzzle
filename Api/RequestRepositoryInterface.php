<?php
namespace Coskun\EasyGuzzle\Api;

interface RequestRepositoryInterface
{
    /**
     *
     * @param array $params
     * @return mixed
     */
    public function doRequest($params = []);

}

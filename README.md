
# Easy Guzzle

This is a Magento 2 Module. The module allows you to easily use connection Rest APIs using Guzzle.

# Installation

- Create "***Coskun***" folder under "***App/Code/EasyGuzzle***" and add the module into it.
- Run "`bin/php magento setup:upgrade`".
- Run "`bin/php magento cache:clean`".

# Usage

You may see "example/example.php" file.

The Interface has only one method, and you have to call it with the below array is enough.

    [  
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

**Connection Data**
| # | Description | Required |
|--|--|--|
| apiUrl | Request URL | Yes |
| token | It's a "bearer token". If you need to send a bearer token, you should add it here. | No |
| method | Default method is GET, but also you may use POST, PUT, or DELETE.  | No |

**Query**
If you want to send a query parameter, you may use this area. It's not a required option. But its type must be an array.

**Parameters**
If you want to send JSON parameters in the body, you may use this area. It's not a required option. But its type must be an array.

> The parameters format will be "application/json" when sending to API

 
# Licence

It is free software distributed under the terms of the MIT license.

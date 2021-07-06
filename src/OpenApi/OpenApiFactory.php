<?php

namespace App\OpenApi;

use ApiPlatform\Core\OpenApi\OpenApi;
use ApiPlatform\Core\OpenApi\Model\RequestBody;
use ApiPlatform\Core\OpenApi\Model\PathItem;
use ApiPlatform\Core\OpenApi\Model\Operation;
use ApiPlatform\Core\OpenApi\Factory\OpenApiFactoryInterface;

class OpenApiFactory implements OpenApiFactoryInterface {

    private OpenApiFactoryInterface $decorated;

    public function __construct(OpenApiFactoryInterface $decorated)
    {
        $this->decorated = $decorated;
    }

    public function __invoke(array $context = []): OpenApi
    {
        $openApi = $this->decorated->__invoke($context);

        /** 
         * @var PathItem $path
         */
        foreach($openApi->getPaths()->getPaths() as $key => $path) {
            if ($path->getGet() && $path->getGet()->getSummary() === "hidden")
                $openApi->getPaths()->addPath($key, $path->withGet(null));
        }

        $schemas = $openApi->getComponents()->getSecuritySchemes();
        $schemas['cookieAuth'] = new \ArrayObject([
            'type' => 'apiKey',
            'in' => 'cookie',
            'name' => 'PHPSESSID'
        ]);

        $schemas = $openApi->getComponents()->getSchemas();
        $schemas['Credentials'] = new \ArrayObject([
            'type' => 'object',
            'properties' => [
                'username' => [
                    'type' => 'string',
                    'example' => 'name@exmaple.com'
                ],
                'password' => [
                    'type' => 'string',
                    'example' => '0000'
                ]
            ]
        ]);

        $pathItem = new PathItem(
            post: new Operation(
                operationId: 'postApiLogin',
                tags: ['Auth'],
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Credentials'
                            ]
                        ]
                    ])
                ),
                responses: [
                    '200' => [
                        'description' => "User connected",
                        'content' => [
                            'application/json' => [
                                'schema' => [
                                    '$ref' => '#/components/schemas/User-read.User'
                                ] 
                            ]
                        ]
                    ]
                ]
            )
        );

        $openApi->getPaths()->addPath('/api/login', $pathItem);

        $pathItem = new PathItem(
            post: new Operation(
                operationId: 'postApiLogout',
                tags: ['Auth'],
                responses: [
                    '200' => [
                        'description' => "User disconnected"
                    ]
                ]
            )
        );

        $openApi->getPaths()->addPath('/api/logout', $pathItem);

        $pathItem = new PathItem(
            post: new Operation(
                operationId: 'postApiRegister',
                tags:['Auth'],
                requestBody: new RequestBody(
                    content: new \ArrayObject([
                        'application/json' => [
                            'schema' => [
                                '$ref' => '#/components/schemas/Credentials'
                            ]
                        ]
                    ])
                ),
                responses: [
                    '201' => [
                        'description' => "User created"
                    ],
                    '401' => [
                        'description' => "An error has been throw, see the 'error_message' key"
                    ]
                ]
            )
        );

        $openApi->getPaths()->addPath('/api/register', $pathItem);

        return $openApi;
    }
}
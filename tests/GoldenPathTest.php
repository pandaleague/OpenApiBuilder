<?php

namespace PandaLeague\OpenApiBuilder\Tests;

use PandaLeague\OpenApiBuilder\Components;
use PandaLeague\OpenApiBuilder\Contact;
use PandaLeague\OpenApiBuilder\Info;
use PandaLeague\OpenApiBuilder\License;
use PandaLeague\OpenApiBuilder\Logo;
use PandaLeague\OpenApiBuilder\MediaType;
use PandaLeague\OpenApiBuilder\OpenApi;
use PandaLeague\OpenApiBuilder\Operation;
use PandaLeague\OpenApiBuilder\Parameter;
use PandaLeague\OpenApiBuilder\Path;
use PandaLeague\OpenApiBuilder\RequestBody;
use PandaLeague\OpenApiBuilder\Response;
use PandaLeague\OpenApiBuilder\Schema;
use PandaLeague\OpenApiBuilder\Security;
use PandaLeague\OpenApiBuilder\SecurityFlow\HttpFlow;
use PandaLeague\OpenApiBuilder\SecurityScheme;
use PandaLeague\OpenApiBuilder\Server;
use PandaLeague\OpenApiBuilder\Tag;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

final class GoldenPathTest extends TestCase
{
    #[Test]
    public function it_builds_a_full_openapi_document(): void
    {
        $petSchema = new Schema([
            'type' => 'object',
            'properties' => [
                'id' => ['type' => 'integer'],
                'name' => ['type' => 'string'],
            ],
            'required' => ['id', 'name'],
        ]);

        $petRefSchema = new Schema(['$ref' => '#/components/schemas/Pet']);
        $petListSchema = new Schema([
            'type' => 'array',
            'items' => ['$ref' => '#/components/schemas/Pet'],
        ]);

        $listPets = (new Operation())
            ->tag('Pets')
            ->summary('List pets')
            ->operationId('listPets')
            ->parameter(
                (new Parameter('limit', Parameter::IN_QUERY, new Schema(['type' => 'integer'])))
            )
            ->response(
                200,
                (new Response('A list of pets'))
                    ->content('application/json', (new MediaType())->schema($petListSchema))
            );

        $createPet = (new Operation())
            ->tag('Pets')
            ->summary('Create a pet')
            ->operationId('createPet')
            ->requestBody(
                (new RequestBody())
                    ->description('Pet to create')
                    ->content('application/json', (new MediaType())->schema($petRefSchema))
                    ->required(true)
            )
            ->response(201, new Response('Pet created'))
            ->addSecurity(new Security('bearerAuth'));

        $getPet = (new Operation())
            ->tag('Pets')
            ->summary('Get a pet by ID')
            ->operationId('getPet')
            ->parameter(
                new Parameter('petId', Parameter::IN_PATH, new Schema(['type' => 'string']))
            )
            ->response(
                200,
                (new Response('Pet found'))
                    ->content('application/json', (new MediaType())->schema($petRefSchema))
            )
            ->response(404, new Response('Pet not found'));

        $petsPath = (new Path())->get($listPets)->post($createPet);
        $singlePetPath = (new Path())->get($getPet);

        $info = (new Info('Pet Store API', '1.0.0'))
            ->description('A sample pet store')
            ->termsOfService('https://example.com/terms')
            ->contact(
                (new Contact())
                    ->name('API Support')
                    ->url('https://example.com/support')
                    ->email('support@example.com')
            )
            ->license(
                (new License('MIT'))->url('https://opensource.org/licenses/MIT')
            )
            ->logo(
                (new Logo())
                    ->url('https://example.com/logo.png')
                    ->backgroundColor('#FFFFFF')
                    ->altText('Pet Store')
            );

        $components = (new Components())
            ->schema('Pet', $petSchema)
            ->securityScheme(
                'bearerAuth',
                (new SecurityScheme(new HttpFlow('bearer')))->description('JWT bearer token')
            );

        $openApi = (new OpenApi('3.0.0', $info, ['/pets' => $petsPath]))
            ->path('/pets/{petId}', $singlePetPath)
            ->server((new Server('https://api.example.com/v1'))->description('Production'))
            ->components($components)
            ->tag((new Tag('Pets'))->description('Pet operations'));

        $expected = [
            'openapi' => '3.0.0',
            'info' => [
                'title' => 'Pet Store API',
                'version' => '1.0.0',
                'description' => 'A sample pet store',
                'termsOfService' => 'https://example.com/terms',
                'contact' => [
                    'name' => 'API Support',
                    'url' => 'https://example.com/support',
                    'email' => 'support@example.com',
                ],
                'license' => [
                    'name' => 'MIT',
                    'url' => 'https://opensource.org/licenses/MIT',
                ],
                'x-logo' => [
                    'url' => 'https://example.com/logo.png',
                    'backgroundColor' => '#FFFFFF',
                    'altText' => 'Pet Store',
                ],
            ],
            'paths' => [
                '/pets' => [
                    'get' => [
                        'tags' => ['Pets'],
                        'summary' => 'List pets',
                        'operationId' => 'listPets',
                        'parameters' => [
                            [
                                'name' => 'limit',
                                'in' => 'query',
                                'schema' => ['type' => 'integer'],
                            ],
                        ],
                        'responses' => [
                            200 => [
                                'description' => 'A list of pets',
                                'content' => [
                                    'application/json' => [
                                        'schema' => [
                                            'type' => 'array',
                                            'items' => ['$ref' => '#/components/schemas/Pet'],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                        'deprecated' => false,
                    ],
                    'post' => [
                        'tags' => ['Pets'],
                        'summary' => 'Create a pet',
                        'operationId' => 'createPet',
                        'requestBody' => [
                            'description' => 'Pet to create',
                            'content' => [
                                'application/json' => [
                                    'schema' => ['$ref' => '#/components/schemas/Pet'],
                                ],
                            ],
                            'required' => true,
                        ],
                        'responses' => [
                            201 => [
                                'description' => 'Pet created',
                            ],
                        ],
                        'deprecated' => false,
                        'security' => [
                            ['bearerAuth' => []],
                        ],
                    ],
                ],
                '/pets/{petId}' => [
                    'get' => [
                        'tags' => ['Pets'],
                        'summary' => 'Get a pet by ID',
                        'operationId' => 'getPet',
                        'parameters' => [
                            [
                                'name' => 'petId',
                                'in' => 'path',
                                'required' => true,
                                'schema' => ['type' => 'string'],
                            ],
                        ],
                        'responses' => [
                            200 => [
                                'description' => 'Pet found',
                                'content' => [
                                    'application/json' => [
                                        'schema' => ['$ref' => '#/components/schemas/Pet'],
                                    ],
                                ],
                            ],
                            404 => [
                                'description' => 'Pet not found',
                            ],
                        ],
                        'deprecated' => false,
                    ],
                ],
            ],
            'servers' => [
                [
                    'url' => 'https://api.example.com/v1',
                    'description' => 'Production',
                ],
            ],
            'components' => [
                'schemas' => [
                    'Pet' => [
                        'type' => 'object',
                        'properties' => [
                            'id' => ['type' => 'integer'],
                            'name' => ['type' => 'string'],
                        ],
                        'required' => ['id', 'name'],
                    ],
                ],
                'securitySchemes' => [
                    'bearerAuth' => [
                        'description' => 'JWT bearer token',
                        'type' => 'http',
                        'scheme' => 'bearer',
                    ],
                ],
            ],
            'tags' => [
                ['name' => 'Pets', 'description' => 'Pet operations'],
            ],
        ];

        $this->assertSame($expected, $openApi->toArray());
    }
}

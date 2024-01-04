<?php
// src/Service/CartService.php
namespace App\Service;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiAmiiboService
{
    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

  public function fetchApi(): array
    {
        $response = $this->client->request(
            'GET',
            'https://www.amiiboapi.com/api/amiibo/?'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        // $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content["amiibo"];
    }
    public function fetchAmiiboseries(): array
    {
        $response = $this->client->request(
            'GET',
            'https://amiiboapi.com/api/amiiboseries/'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        // $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content["amiibo"];
    }

    public function fetchSpecificAmiibosFromSeries(): array
    {
        $response = $this->client->request(
            'GET',
            'https://www.amiiboapi.com/api/amiibo/?amiiboSeries=Legend%20Of%20Zelda'
        );

        $statusCode = $response->getStatusCode();
        // $statusCode = 200
        $contentType = $response->getHeaders()['content-type'][0];
        // $contentType = 'application/json'
        // $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content["amiibo"];
    }
}
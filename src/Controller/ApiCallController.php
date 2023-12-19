<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class ApiCallController extends AbstractController
{

    public function __construct(
        private HttpClientInterface $client,
    ) {
    }

    #[Route('/apicall', name: 'app_api_call', methods: ['GET'])]

    public function index(): Response
    {
        return $this->render('api_call/index.html.twig', [
            'details' => $this->fetchApi()
        ]);

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
        $content = $response->getContent();
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
        $content = $response->getContent();
        // $content = '{"id":521583, "name":"symfony-docs", ...}'
        $content = $response->toArray();
        // $content = ['id' => 521583, 'name' => 'symfony-docs', ...]

        return $content["amiibo"];
    }
}

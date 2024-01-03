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
            'details' => $this->dateTransform($this->fetchSpecificAmiibosFromSeries())
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
    public function dateTransform(array $content): array
    {
        foreach ($content as $key => $value) {

            // Create a DateTime object from the string
            $date = new \DateTime($value['release']['eu']);

            // Format the DateTime object to d/m/Y format
            $formattedDate = $date->format('d/m/Y');

            $content[$key]['release']['eu'] = $formattedDate;
        }
        return $content;
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

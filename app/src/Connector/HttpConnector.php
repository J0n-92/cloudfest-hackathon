<?php declare(strict_types=1);

namespace App\Connector;

use Symfony\Component\HttpClient\Exception\ClientException;
use Symfony\Component\HttpClient\NativeHttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class HttpConnector
{
    private HttpClientInterface $httpClient;

    public function __construct(HttpClientInterface $httpClient)
    {

        $this->httpClient = $httpClient;
    }

    public function postData(array $options): void
    {
        try {
            $this->httpClient->request(
                'POST',
                'https://signing-api.sign.net/signing-api/documents',
                $options

            );
        } catch (ClientException $e) {
            $response = $e->getResponse();
            echo $response->getInfo('debug');
        }
    }
}

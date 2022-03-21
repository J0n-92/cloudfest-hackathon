<?php declare(strict_types=1);

namespace App\SignNetApi;

use App\Connector\HttpConnector;
use Symfony\Component\Mime\Part\DataPart;
use Symfony\Component\Mime\Part\Multipart\FormDataPart;

class UploadDocument
{
    private HttpConnector $httpConnector;

    public function __construct(HttpConnector $httpConnector)
    {
        $this->httpConnector = $httpConnector;
    }

    public function sendDocument(string $path): void
    {
        $data = [
            'domain' => '',
            'title' => '',
            'fileName' => '',
            'ownerEmail' => 'nigel@sign.net',
            'signers' => '[]',
            'viewers' => '[]',
            'dueDate' => '29-03-2022',
            'additionalMsg' => '',
            'requireNotarisation' => '',
            'passcode' => 'null',
            'file' => DataPart::fromPath(__DIR__ . '/../../var/dummy.pdf'),
        ];

        $formData = new FormDataPart($data);

        $headers = $formData->getPreparedHeaders();
        $headers->addHeader(
            'Authorization',
            'Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1c2VySWQiOiIzODRiNDZmMzgzMGE0NmZjODk5ZDdmYjliZDQ4YjVmZiIsImlhdCI6MTY0NzUwMjc5MH0.O3i5hfgEP0qW29PRVqW31b3F1Iaf2Frcq1o2qBnd58Y'
        );

        $this->httpConnector->postData(
            [
                'headers' => $headers->toArray(),
                'body' => $formData->bodyToString(),
            ]
        );
    }
}

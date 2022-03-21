<?php

namespace App\Controller;

use App\SignNetApi\UploadDocument;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SignNetController extends AbstractController
{
    #[Route('/sign-net/sign/file', name: 'app_sign_net_sign_file')]
    public function index(UploadDocument $uploadDocument): Response
    {
        // From request
        $signNetApiKey = 'Key to your SignNet account';
        $file = 'somePath or encoded file';
        $uploadDocument->sendDocument($file);

        return new Response();
    }
}

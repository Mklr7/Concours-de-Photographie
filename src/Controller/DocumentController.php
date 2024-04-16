<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class DocumentController extends AbstractController
{ 
    public function attestation(string $filename): Response
    {
        $filePath = $this->getParameter('app.path.attestation') . '/' . $filename;

        return $this->file($filePath);
    }
}

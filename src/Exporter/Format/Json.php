<?php 

namespace App\Exporter\Format;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;

class Json implements FormatInterface 
{
    public function export($content, $filename): Response
    {
        $response = new Response();
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            $filename
        );
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', 'application/json');
        $response->setContent(
            json_encode($content)
        );

        return $response;
    }
}
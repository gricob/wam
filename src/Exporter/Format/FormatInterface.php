<?php 

namespace App\Exporter\Format;

use Symfony\Component\HttpFoundation\Response;

interface FormatInterface
{
    public function export($content, string $filename): Response;
}
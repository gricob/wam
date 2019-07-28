<?php 

namespace App\Exporter;

use Symfony\Component\HttpFoundation\Response;

interface ExporterInterface 
{
    public function content($content): ExporterInterface;
    public function exportTo(string $format, string $filename): Response;
}
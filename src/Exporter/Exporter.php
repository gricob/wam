<?php 

namespace App\Exporter;

use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Response;
use App\Exception\UnsupportedFormatException;

class Exporter implements ExporterInterface
{
    private $content;

    public function content($content): ExporterInterface
    {
        $this->content = $content;

        return $this;
    }

    public function exportTo(string $format, string $filename): Response
    {
        $formatClass = __NAMESPACE__ . '\\Format\\' . ucfirst($format);

        if(!class_exists($formatClass)) {
            throw new UnsupportedFormatException($format);
        }
        
        return (new $formatClass)->export($this->content, $filename);
    }
}
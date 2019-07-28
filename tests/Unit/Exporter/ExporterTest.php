<?php 

namespace App\Tests\Unit\Exporter;

use App\Exporter\Exporter;
use PHPUnit\Framework\TestCase;
use App\Exception\UnsupportedFormatException;

class ExporterTest extends TestCase
{
    /** @test */
    public function unsupported_format_throws_exception()
    {
        $this->expectException(UnsupportedFormatException::class);

        (new Exporter)->exportTo('unsupported', 'file.fake');
    }
}
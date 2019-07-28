<?php

namespace App\Tests\Feature;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ExportJsonTest extends WebTestCase
{
    private function assertExported($body, $query = null)
    {
        $client = static::createClient();
        $client->request('GET', "/reservations/json" . (!empty($query) ? "?q=$query" : ''));

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        
        $this->assertEquals(
            'application/json', 
            $client->getResponse()->headers->get('Content-Type')
        );

        $this->assertEquals(
            'attachment; filename=reservas.json',
            $client->getResponse()->headers->get('Content-Disposition')
        );

        $this->assertJsonStringEqualsJsonString(
            $body,
            $client->getResponse()->getContent()
        );
    }

    /** @test */
    public function can_export_to_json_without_query()
    {
        $this->assertExported(
            '[
                {
                    "id": "34637",
                    "guest": "Nombre 1",
                    "checkin": "2018-10-04",
                    "checkout": "2018-10-05",
                    "hotel": "Hotel 4",
                    "amount": "112.49",
                    "actions": "Cobrar Devolver"
                },
                {
                    "id": "34694",
                    "guest": "Nombre 2",
                    "checkin": "2018-06-15",
                    "checkout": "2018-06-17",
                    "hotel": "Hotel 1",
                    "amount": "427.77",
                    "actions": "Cancelar"
                }
            ]'
            );
    }

    /** @test */
    public function can_export_to_json_with_query()
    {
        $this->assertExported(
            '[
                {
                    "id": "34637",
                    "guest": "Nombre 1",
                    "checkin": "2018-10-04",
                    "checkout": "2018-10-05",
                    "hotel": "Hotel 4",
                    "amount": "112.49",
                    "actions": "Cobrar Devolver"
                }
            ]',
            '34637'
        );
    }
}

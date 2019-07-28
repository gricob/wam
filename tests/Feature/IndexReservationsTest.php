<?php 

namespace App\Tests\Feature;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexReservationsTest extends WebTestCase
{
    use ReservationAsserts;

    /** @test */
    public function can_index_reservations()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/reservations');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(2, $crawler->filter('tr.reservation')->count());
        $this->assertContainsReservation(34637, 'Nombre 1', '2018-10-04', '2018-10-05', 'Hotel 4', '112.49', 'Cobrar Devolver');
        $this->assertContainsReservation(34694, 'Nombre 2', '2018-06-15', '2018-06-17', 'Hotel 1', '427.77', 'Cancelar');
    }
}
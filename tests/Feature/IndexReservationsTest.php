<?php 

namespace Tests\Feature;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class IndexReservationsTest extends WebTestCase
{
    /** @test */
    public function can_index_reservations()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/reservations');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(2, $crawler->filter('tr.reservation')->count());
        $this->assertContainsReservation(34637, 'Nombre 1', '2018-10-04', '2018-10-05', 'Hotel 4', '112.49', 'Cobrar Devolver');
        $this->assertContainsReservation(34694, 'Nombre 2', '2018-06-15', '2018-06-17', 'Hotel 1', '427.77', 'Cobrar Devolver');
    }

    private function assertContainsReservation($id, $guest, $checkin, $checkout, $hotel, $amount, $actions)
    {
        $this->assertSelectorTextContains("tr#reservation-$id .id", $id);
        $this->assertSelectorTextContains("tr#reservation-$id .guest", $guest);
        $this->assertSelectorTextContains("tr#reservation-$id .checkin", $checkin);
        $this->assertSelectorTextContains("tr#reservation-$id .checkout", $checkout);
        $this->assertSelectorTextContains("tr#reservation-$id .hotel", $hotel);
        $this->assertSelectorTextContains("tr#reservation-$id .amount", $amount);
        $this->assertSelectorTextContains("tr#reservation-$id .actions", $actions);
    }
}
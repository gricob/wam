<?php 

namespace App\Tests\Feature;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FilterReservationsTest extends WebTestCase
{
    use ReservationAsserts;

    public function filterQueriesProvider()
    {
        yield ['34637'];
        yield ['Nombre 1'];
        yield ['2018-10-04'];
        yield ['2018-10-05'];
        yield ['Hotel 4'];
        yield ['112.49'];
        yield ['Cobrar Devolver'];
    }

    /** 
     * @test 
     * @dataProvider filterQueriesProvider
     * */
    public function can_filter_reservations($query)
    {
        $client = static::createClient();

        $crawler = $client->request('GET', "/reservations?q=$query");

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertEquals(1, $crawler->filter('tr.reservation')->count());
        $this->assertContainsReservation(34637, 'Nombre 1', '2018-10-04', '2018-10-05', 'Hotel 4', '112.49', 'Cobrar Devolver');
    }
}
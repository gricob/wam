<?php 

namespace App\Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Model\Reservation;

class ReservationTest extends TestCase 
{
    public function queriesProvider()
    {
        yield ['3256', true];
        yield ['John', true];
        yield ['2019-10-04', true];
        yield ['2019-10-06', true];
        yield ['Fake hotel', true];
        yield ['555.55', true];
        yield ['Test', true];
        yield ['3257', false];
        yield ['Yoko', false];
        yield ['2019-10-05', false];
        yield ['2019-10-07', false];
        yield ['Another hotel', false];
        yield ['666.66', false];
        yield ['Test Action', false];
        yield ['', false];
    }

    /** 
     * @test 
     * @dataProvider queriesProvider
     * */
    public function can_check_if_reservation_contains_query($query, $expected)
    {
        $reservation = Reservation::createFromArray([
            'id' => '3256',
            'guest' => 'John',
            'checkin' => '2019-10-04',
            'checkout' => '2019-10-06',
            'hotel' => 'Fake hotel',
            'amount' => '555.55',
            'actions' => 'Test'
        ]);

        $this->assertEquals($expected, $reservation->contains($query));
    }
}
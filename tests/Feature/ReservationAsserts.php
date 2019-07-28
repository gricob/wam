<?php 

namespace App\Tests\Feature;

trait ReservationAsserts
{
    protected function assertContainsReservation($id, $guest, $checkin, $checkout, $hotel, $amount, $actions)
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
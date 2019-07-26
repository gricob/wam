<?php 

namespace App\Model;

class Reservation
{
    public $id;

    public $guest;

    public $checkin;

    public $checkout;

    public $hotel;

    public $amount;

    public $actions;

    public static function createFromArray($attributes)
    {
        $reservation = new Reservation;
        $reservation->id = $attributes['id'];
        $reservation->guest = $attributes['guest'];
        $reservation->checkin = $attributes['checkin'];
        $reservation->checkout = $attributes['checkout'];
        $reservation->hotel = $attributes['hotel'];
        $reservation->amount = $attributes['amount'];
        $reservation->actions = $attributes['actions'];

        return $reservation;
    }

    public function contains($value): bool
    {
        foreach(get_object_vars($this) as $property) {
            if(strpos($property, $value) !== false) 
                return true;
        }

        return false;
    }
}
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

    /**
     * Crea la reserva a partir de un array asociativo
     *
     * @param array $attributes
     * @return void
     */
    public static function createFromArray(array $attributes)
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

    /**
     * Comprueba si la reserva contiene el valor pasado como parámetro 
     * en alguna de sus propiedades
     *
     * @param string $value
     * @return boolean
     */
    public function contains(string $value): bool
    {
        if(empty($value)) return false;

        foreach(get_object_vars($this) as $property) {
            if(strpos($property, $value) !== false) 
                return true;
        }

        return false;
    }
}
<?php 

namespace App\Repository\Csv;

use App\Model\Reservation;
use App\Repository\Repository;

class ReservationRepository implements Repository
{
    /**
     * Devuelve todos los registros
     *
     * @return array
     */
    public function all(): array
    {
        $raw = fopen($_ENV['RESERVATIONS_CSV'], 'r');

        $reservations = [];
        while(($reservation = fgetcsv($raw, 0, ';')) !== false) {
            if(count($reservation) == 7) {
                $reservations[] = Reservation::createFromArray([
                    'id' => $reservation[0],
                    'guest' => $reservation[1],
                    'checkin' => $reservation[2],
                    'checkout' => $reservation[3],
                    'hotel' => $reservation[4],
                    'amount' => $reservation[5],
                    'actions' => $reservation[6]
                ]);
            }
        }

        return $reservations;
    }

    /**
     * Devuelve los registros que contienen el valor pasado como parámetro
     *
     * @param string $query
     * @return array
     */
    public function find(string $query): array 
    {
        $reservations = $this->all();

        return array_filter($reservations, function($reservation) use ($query) {
            return $reservation->contains($query);
        });
    }
}
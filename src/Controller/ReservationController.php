<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;

class ReservationController
{
    public function index()
    {
        $raw = fopen($_ENV['RESERVATIONS_CSV'], 'r');

        $html = 
        '<table>
            <tbody>';

        while(($reservation = fgetcsv($raw, 0, ';')) !== false) {
            if(count($reservation) == 7) {
                $html .= 
                "<tr id='reservation-$reservation[0]' class='reservation'>
                <td class='id'>$reservation[0]</td>
                <td class='guest'>$reservation[1]</td>
                <td class='checkin'>$reservation[2]</td>
                <td class='checkout'>$reservation[3]</td>
                <td class='hotel'>$reservation[4]</td>
                <td class='amount'>$reservation[5]</td>
                <td class='actions'>$reservation[6]</td>
                </tr>";
            }
        }

        $html .= 
            '</tbody>
        </table>';

        return new Response($html);
    }
}
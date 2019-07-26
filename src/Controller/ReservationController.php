<?php 

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    public function index()
    {
        $raw = fopen($_ENV['RESERVATIONS_CSV'], 'r');

        $reservations = [];
        while(($reservation = fgetcsv($raw, 0, ';')) !== false) {
            if(count($reservation) == 7) {
                $reservations[] = $reservation;
            }
        }

        return $this->render('reservations/index.html.twig', [
            'reservations' => $reservations
        ]);
    }
}
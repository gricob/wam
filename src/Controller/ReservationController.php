<?php 

namespace App\Controller;

use App\Repository\Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function index()
    {
        return $this->render('reservations/index.html.twig', [
            'reservations' => $this->repository->all()
        ]);
    }
}
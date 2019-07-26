<?php 

namespace App\Controller;

use App\Repository\Repository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function index(Request $request)
    {
        $reservations = 
            $request->query->has('q') 
                ? $this->repository->find($request->query->get('q'))
                : $this->repository->all();

        return $this->render('reservations/index.html.twig', [
            'reservations' => $reservations
        ]);
    }
}
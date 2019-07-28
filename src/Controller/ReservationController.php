<?php 

namespace App\Controller;

use App\Repository\Repository;
use Symfony\Component\HttpFoundation\Request;
use App\Exporter\ExporterInterface as Exporter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReservationController extends AbstractController
{
    private $repository;

    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    private function getReservationsFromRequest(Request $request)
    {
        return $request->query->has('q') && !empty($request->query->get('q'))
            ? $this->repository->find($request->query->get('q'))
            : $this->repository->all();
    }

    public function index(Request $request)
    {
        return $this->render('reservations/index.html.twig', [
            'query' => $request->query->get('q'),
            'reservations' => $this->getReservationsFromRequest($request)
        ]);
    }

    /**
     * Convierte las reservas al formato especificado y
     * devuelve el resultado como fichero
     *
     * @param Exporter $exporter
     * @param Request $request
     * @param string $format
     * @return void
     */
    public function export(Exporter $exporter, Request $request, string $format)
    {
        return $exporter->content($this->getReservationsFromRequest($request))
                        ->exportTo($format, 'reservas.json');
    }
}
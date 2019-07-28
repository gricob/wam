<?php 

namespace App\Controller;

use App\Repository\Repository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\ResponseHeaderBag;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\SerializerInterface as Serializer;

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
     * @param Serializer $serializer
     * @param Request $request
     * @param string $format
     * @return void
     */
    public function export(Serializer $serializer, Request $request, string $format)
    {
        $response = new Response();
        $disposition = $response->headers->makeDisposition(
            ResponseHeaderBag::DISPOSITION_ATTACHMENT,
            "reservas.$format"
        );
        $response->headers->set('Content-Disposition', $disposition);
        $response->headers->set('Content-Type', "application/$format");
        $response->setContent(
            $serializer->serialize(
                $this->getReservationsFromRequest($request),
                $format
            )
        );
        
        return $response;
    }
}
<?php

namespace App\Controller;

use App\Repository\EventRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class EventController extends AbstractController
{
    #[Route('/event', name: 'app_event', methods: 'GET')]
    public function index(Request $request, EventRepository $eventRepository): JsonResponse
    {
        $address = $request->query->get('address');
        $result = $eventRepository->getEventByAddress($address);
        if ($result) {
            return new JsonResponse($result);
        }
        return new JsonResponse([], 400);
    }
    #[Route('/allEvents')]
    public function getAllEvents(EventRepository $eventRepository): JsonResponse
    {
        $result = $eventRepository->getAllEvents();
        if ($result) {
            return new JsonResponse($result);
        }
        return new JsonResponse([], 400);
    }
}

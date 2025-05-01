<?php

namespace App\Controller;

use App\Repository\ConferenceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ConferenceController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(ConferenceRepository $conferenceRepository): Response
    {
        $conferences = $conferenceRepository->findAll();

        return $this->render('conference/index.html.twig', [
            'conferences' => $conferences,
        ]);
    }


    #[Route('/conference/{id}', name: 'conference_show')]
    public function show(int $id, ConferenceRepository $conferenceRepository): Response
    {
        $conference = $conferenceRepository->find($id);

        if (!$conference) {
            throw $this->createNotFoundException('Conférence non trouvée');
        }

        return $this->render('conference/show.html.twig', [
            'conference' => $conference,
        ]);
    }

}

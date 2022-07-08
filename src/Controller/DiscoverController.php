<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/discover", name="movie_discover")
 */
class DiscoverController extends AbstractController
{
    public function __invoke(
        Request $request,
        MovieRepository $movieRepository
    ): Response {
        $filters = [
            'with_genres' => $request->query->get('genreids')
        ];

        $movies = $movieRepository->getList($filters);

        return $this->render('movie/list.html.twig', [
            'movies' => $movies,
        ]);
    }
}

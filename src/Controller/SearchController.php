<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/search", name="movie_search")
 */
class SearchController extends AbstractController
{
    public function __invoke(
        MovieRepository $movieRepository,
        Request $request
    ): Response {
        $term = $request->query->get('term');
        $movies = $movieRepository->searchMovies($term);

        return $this->json($movies);
    }
}

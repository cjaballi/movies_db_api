<?php

namespace App\Controller;

use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/movie/{movieId<\d+>}", name="movie_detail")
 */
class MovieDetailController extends AbstractController
{
    public function __invoke(
        MovieRepository $movieRepository,
        int $movieId
    ): Response {
        $movie = $movieRepository->get($movieId);
        $video = $movieRepository->getVideos($movieId)->first();

        return $this->render('movie/view.html.twig', [
            'movie' => $movie,
            'video' => $video,
        ]);
    }
}

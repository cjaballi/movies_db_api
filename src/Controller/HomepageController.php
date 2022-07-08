<?php

namespace App\Controller;

use App\Repository\ConfigurationRepository;
use App\Repository\GenreRepository;
use App\Repository\MovieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/", name="homepage")
 */
class HomepageController extends AbstractController
{
    public function __invoke(
        ConfigurationRepository $configurationRepository,
        MovieRepository         $movieRepository,
        GenreRepository         $genreRepository
    ): Response
    {
        $popularMovies = $movieRepository->getPopularMovies();
        $featuredMovie = $popularMovies->first();
        $mainVideo = $movieRepository->getVideos($featuredMovie->getId())->first();
        $genres = $genreRepository->getAll();

        return $this->render('homepage.html.twig', [
            'movies' => $popularMovies,
            'genres' => $genres,
            'featured_movie' => $featuredMovie,
            'main_video' => $mainVideo
        ]);
    }
}

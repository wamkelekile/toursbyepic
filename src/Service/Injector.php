<?php


namespace App\Service;


use App\Repository\ArticleRepository;
use App\Repository\CountryRepository;

class Injector
{
    private $articleRepository;

    private $countryRepository;

    public function __construct(ArticleRepository $articleRepository, CountryRepository $countryRepository)
    {
        $this->articleRepository = $articleRepository;
        $this->countryRepository = $countryRepository;
    }

    public function articles(): array
    {
        return  $this->articleRepository->findAll();
    }

    public function countries(): array
    {
        return  $this->countryRepository->findAll();
    }
}
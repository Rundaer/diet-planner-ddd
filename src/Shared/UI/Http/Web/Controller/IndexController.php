<?php

namespace App\Shared\UI\Http\Web\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class IndexController extends AbstractController
{
    #[Route(
        path: '/index/',
        name: 'index',
        methods: ['GET']
    )]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }
}
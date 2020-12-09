<?php

declare(strict_types=1);

namespace App\Application\Action;

use Symfony\Component\HttpFoundation\Response;
use Twig\Environment as Twig;

final class FrontAction
{
    private Twig $templating;

    public function __construct(Twig $templating)
    {
        $this->templating = $templating;
    }

    public function __invoke(): Response
    {
        return Response::create($this->templating->render('app.html.twig'));
    }
}

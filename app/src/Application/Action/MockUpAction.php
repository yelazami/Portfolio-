<?php

declare(strict_types=1);

namespace App\Application\Action;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Twig\Environment as Twig;

final class MockUpAction
{
    private Twig $templating;

    private string $environment;

    public function __construct(Twig $templating, string $environment)
    {
        $this->templating  = $templating;
        $this->environment = $environment;
    }

    public function __invoke(): Response
    {
        if ($this->environment !== 'dev') {
            throw new NotFoundHttpException();
        }

        return Response::create($this->templating->render('mock_up.html.twig'));
    }
}

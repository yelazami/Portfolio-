<?php

declare(strict_types=1);

namespace App\Application\Security\Action;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Twig\Environment as Twig;

class LoginAction
{
    private Twig $template;

    public function __construct(Twig $template)
    {
        $this->template = $template;
    }

    public function __invoke(AuthenticationUtils $authenticationUtils): Response
    {
        $error        = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return new Response(
            $this->template->render('login.html.twig', [
                'last_username' => $lastUsername,
                'error'         => $error
            ])
        );
    }
}

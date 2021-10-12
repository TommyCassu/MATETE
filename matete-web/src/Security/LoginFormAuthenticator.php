<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AuthenticatorInterface;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class LoginFormAuthenticator implements AuthenticatorInterface
{
    public function supports(Request $request): ?bool
    {
        $request->attributes->get('_route');
    }

    public function authenticate(Request $request): PassportInterface
    {

    }

    public function createAuthenticatedToken(PassportInterface $passport, string $firewallName): TokenInterface
    {

    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {

    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {

    }
}
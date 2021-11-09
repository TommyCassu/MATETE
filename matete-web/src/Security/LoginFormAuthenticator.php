<?php

namespace App\Security;

use App\Repository\ProducteurRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\PasswordUpgradeBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;

class LoginFormAuthenticator extends AbstractAuthenticator
{
    private $producteurRepository;
    private $urlGenerator;

    public function __construct(ProducteurRepository $producteurRepository, UrlGeneratorInterface $urlGenerator)
    {
        $this->producteurRepository = $producteurRepository;
        $this->urlGenerator = $urlGenerator;
    }

    public function supports(Request $request): ?bool
    {
        return $request->attributes->get('_route') === 'login_security'
            && $request->isMethod('POST');
    }

    public function authenticate(Request $request): PassportInterface
    {
        $producteur = $this->producteurRepository->findOneByMail($request->request->get('mail'));
        if (!$producteur) {
            throw new UsernameNotFoundException();
        }

        return new Passport($producteur, new PasswordCredentials($request->request->get('password')), [
            new CsrfTokenBadge('login_form', $request->request->get('csrf_token')),
            new PasswordUpgradeBadge($request->request->get('password'), $this->producteurRepository)
        ]);
    }

    public function createAuthenticatedToken(PassportInterface $passport, string $firewallName): TokenInterface
    {

    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new RedirectResponse($this->urlGenerator->generate('main_page'));
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return new RedirectResponse($this->urlGenerator->generate('login_security'));
    }
}
<?php

namespace App\Security;

use App\Model\User\Entity\User;
use App\Model\User\Entity\UserRepository;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\UserNotFoundException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Http\Authenticator\AbstractLoginFormAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\CsrfTokenBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\CustomCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Http\Authenticator\Passport\PassportInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;

class SecurityAuthenticator extends AbstractLoginFormAuthenticator
{
    use TargetPathTrait;

    public const LOGIN_ROUTE = 'login';

    private UrlGeneratorInterface $urlGenerator;
    private UserRepository $users;
    
    public function __construct(UrlGeneratorInterface $urlGenerator, UserRepository $users)
    {
        $this->urlGenerator = $urlGenerator;
        $this->users = $users;
    }

    public function supports(Request $request): bool
    {
        return '/login' === $request->getPathInfo() && $request->isMethod('POST');
    }
    
    public function authenticate(Request $request): PassportInterface
    {
        $phone = $request->request->get('phone', '');
        $password = $request->request->get('password', '');

        $request->getSession()->set(Security::LAST_USERNAME, $phone);
    
        return new Passport(
            new UserBadge($phone, function ($phone) {
                return $this->users->findByPhone($phone) ?? throw new UserNotFoundException();
            }),
            new CustomCredentials(function ($credentials, User $user) {
                return password_verify($credentials, $user->getPassword());
            }, $password),
            [
                new CsrfTokenBadge('authenticate', $request->request->get('_csrf_token')),
            ]
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        return new RedirectResponse($this->urlGenerator->generate('profile'));
    }
    
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): Response
    {
        return parent::onAuthenticationFailure($request, $exception);
    }
    
    protected function getLoginUrl(Request $request): string
    {
        return $this->urlGenerator->generate(self::LOGIN_ROUTE);
    }
}

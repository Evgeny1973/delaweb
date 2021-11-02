<?php

namespace App\Model\User\UseCase\SignUp;

use App\Flusher;
use App\Model\Organization\Entity\Organization;
use App\Model\Organization\Entity\OrganizationRepository;
use App\Model\User\Entity\Name;
use App\Model\User\Entity\User;
use App\Model\User\Entity\UserRepository;
use Doctrine\ORM\EntityNotFoundException;

final class SignUpHandler
{
    private UserRepository $users;
    private OrganizationRepository $organizations;
    private Flusher $flusher;
    
    public function __construct(
        UserRepository $users,
        OrganizationRepository $organizations,
        Flusher $flusher
    ) {
        $this->users = $users;
        $this->organizations = $organizations;
        $this->flusher = $flusher;
    }
    
    public function handle(SignUpCommand $command): void
    {
        if ($this->users->findByPhone($command->phone)) {
            throw new \DomainException(sprintf('Пользователь с тел. номером %s уже зарегистрирован.', $command->phone));
        }
    
        $organization = $this->organizations->findByName($command->organization);
        
        if (!$organization instanceof Organization) {
            $this->organizations->add(new Organization($command->organization));
            $this->flusher->flush();
        }
        
        $user = new User(
            (new Name($command->firstName))->getValue(),
            (new Name($command->lastName))->getValue(),
            $command->phone,
            password_hash($command->password, PASSWORD_DEFAULT),
            $command->host,
            $organization->getId()
        );
        
        $this->users->add($user);
        $this->flusher->flush();
    }
}

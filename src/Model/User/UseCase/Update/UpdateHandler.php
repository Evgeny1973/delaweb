<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Update;

use App\Flusher;
use App\Model\Organization\Entity\OrganizationRepository;
use App\Model\User\Entity\UserRepository;
use Doctrine\ORM\EntityNotFoundException;
use Symfony\Component\Messenger\Handler\MessageHandlerInterface;

final class UpdateHandler implements MessageHandlerInterface
{
    private UserRepository $users;
    private OrganizationRepository $organizations;
    private Flusher $flusher;
    
    public function __construct(UserRepository $users, OrganizationRepository $organizations, Flusher $flusher)
    {
        $this->users = $users;
        $this->organizations = $organizations;
        $this->flusher = $flusher;
    }
    
    public function __invoke(UpdateCommand $command)
    {
        try {
            $user = $this->users->get($command->id);
        } catch (EntityNotFoundException $e) {
            throw new \DomainException($e->getMessage());
        }
        
        $user->edit(
            $command->firstName,
            $command->lastName,
            $command->phone,
            $command->host,
            $command->organization
        );
        
        $this->flusher->flush();
    }
}

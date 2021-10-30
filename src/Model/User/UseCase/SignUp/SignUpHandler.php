<?php

namespace App\Model\User\UseCase\SignUp;

use App\Flusher;
use App\Model\User\Entity\UserRepository;

class SignUpHandler
{
	public function __construct(UserRepository $users, Flusher $flusher)
	{
	}
    
    public function __invoke(SignUpCommand $command)
    {
        // TODO: Implement __invoke() method.
    }
}

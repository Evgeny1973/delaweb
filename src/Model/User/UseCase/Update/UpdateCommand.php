<?php

declare(strict_types=1);

namespace App\Model\User\UseCase\Update;

use Symfony\Component\Validator\Constraints as Assert;

final class UpdateCommand
{
    /**
     * @var int
     */
    public $id;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Поле {{ label }} не может быть пустым")
     */
    public $firstName;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Поле {{ label }} не может быть пустым")
     */
    public $lastName;
    
    /**
     * @var int
     * @Assert\NotBlank()
     * @Assert\Regex(pattern="^[0-9]+$^", message="Номер телефона должен содержать только цифры.")
     */
    public $phone;
    
    /**
     * @var int|string
     * @Assert\NotBlank(message="Поле {{ label }} не может быть пустым")
     */
    public $host;
    
    /**
     * @var int|string
     * @Assert\NotBlank(message="Поле {{ label }} не может быть пустым")
     */
    public $organization;
    
    public function __construct(int $id)
    {
        $this->id = $id;
    }
    
    /**
     * @param array $user
     * @return static
     */
    public static function fromRequest(array $user): self
    {
        $command = new self((int)$user['id']);
        $command->firstName = $user['firstName'];
        $command->lastName = $user['lastName'];
        $command->phone = $user['phone'];
        $command->host = $user['host'];
        $command->organization = $user['organization'];
        
        return $command;
    }
}

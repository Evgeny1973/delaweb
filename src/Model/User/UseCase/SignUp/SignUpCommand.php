<?php

namespace App\Model\User\UseCase\SignUp;

use Symfony\Component\Validator\Constraints as Assert;

final class SignUpCommand
{
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
     * @var int
     * @Assert\NotBlank(message="Поле {{ label }} не может быть пустым")
     */
    public $host;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Поле {{ label }} не может быть пустым")
     */
    public $organization;
    
    /**
     * @var string
     * @Assert\NotBlank()
     */
    public $password;
}

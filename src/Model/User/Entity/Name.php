<?php

declare(strict_types=1);

namespace App\Model\User\Entity;

final class Name
{
    /**
     * @var string
     */
    private $value;
    
    public function __construct(string $value)
    {
        $this->value = preg_replace('/[^a-zA-Zа-яА-Я0-9 ]/ui', '', $value);
    }
    
    public function getValue(): string
    {
        return $this->value;
    }
}

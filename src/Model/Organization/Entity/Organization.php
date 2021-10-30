<?php

namespace App\Model\Organization\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="organizations", uniqueConstraints={
 * @ORM\UniqueConstraint(columns={"name"})})
 */
class Organization
{
	/**
	 * @var int
	 * @ORM\Id()
	 * @ORM\Column(type="integer", nullable=false)
	 * @ORM\GeneratedValue()
	 */
	private int $id;

	/**
	 * @var string
	 * @ORM\Column(type="string", nullable=false)
	 */
	private string $name;

	public function __construct(string $name)
	{
		$this->name = $name;
	}

	/**
	 * @return int
	 */
	public function getId(): int
	{
		return $this->id;
	}

	/**
	 * @return string
	 */
	public function getName(): string
	{
		return $this->name;
	}
}

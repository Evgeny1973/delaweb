<?php

namespace App\Model\User\Entity;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityNotFoundException;
use Doctrine\ORM\EntityRepository;

final class UserRepository
{
	protected EntityManagerInterface $em;
	private EntityRepository $repo;

	public function __construct(EntityManagerInterface $em)
	{
		$this->repo = $em->getRepository(User::class);
		$this->em = $em;
	}

	/**
	 * @param int $id
	 *
	 * @return User
	 * @throws EntityNotFoundException
	 */
	public function get(int $id): User
	{
		if (!$user = $this->repo->find($id)){
			throw new EntityNotFoundException('User not found');
		}

		return $user;
	}

	/**
	 * @param User $user
	 */
	public function add(User $user): void
	{
		$this->em->persist($user);
	}
}

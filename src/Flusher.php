<?php

namespace App;

use Doctrine\ORM\EntityManagerInterface;

final class Flusher
{
	protected EntityManagerInterface $em;

	public function __construct(EntityManagerInterface $em)
	{
		$this->em = $em;
	}

	public function flush(): void
	{
		$this->em->flush();
	}
}

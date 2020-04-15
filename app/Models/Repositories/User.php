<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\Entities;
use Kdyby\Doctrine\EntityManager;

class User
{

	/** @var EntityManager */
	private $em;

	/** @var User */
	private $users;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
		$this->users = $em->getRepository(Entities\User::class);
	}

	public function getAllUsers() : array
	{
		return $this->users->findAll();
	}

	public function getById(int $id) : Entities\User
	{
		return $this->users->find($id);
	}
}

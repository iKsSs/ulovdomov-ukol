<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use Kdyby\Doctrine\EntityManager;
use App\Models\Entities;
use Kdyby\Doctrine\EntityRepository;


class UserAdmin
{

	/** @var EntityManager */
	private $em;

	/** @var EntityRepository */
	private $users;

	/** @var EntityRepository */
	private $userAdmins;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
		$this->users = $em->getRepository(Entities\User::class);
		$this->userAdmins = $em->getRepository(Entities\UserAdmin::class);
	}

}

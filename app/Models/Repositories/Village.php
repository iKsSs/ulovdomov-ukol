<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use App\Models\Entities;
use Kdyby\Doctrine\EntityManager;

class Village
{

	/** @var EntityManager */
	private $em;

	/** @var Village */
	private $villages;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
		$this->villages = $em->getRepository(Entities\Village::class);
	}

	public function getAllVillages() : array
	{
		return $this->villages->findAll();
	}

	public function getById(int $id) : Entities\Village
	{
		return $this->villages->find($id);
	}
}

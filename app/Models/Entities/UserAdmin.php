<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_admin")
 */
class UserAdmin
{

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer", name="user_id")
	 * @var User
	 */
	private $user;


	public function __construct(User $user)
	{
		$this->user = $user;
	}


	public function getUser() : User
	{
		return $this->user;
	}

	public function setUser(User $user) : void
	{
		$this->user = $user;
	}

}

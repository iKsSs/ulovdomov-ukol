<?php

namespace App\Models\Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="user_permission")
 */
class UserPermission
{

	/**
	 * @ORM\Id
	 * @ORM\ManyToOne(targetEntity="User")
	 * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
	 * @var User
	 */
	private $user;

	/**
	 * @ORM\Id
	 * @ORM\ManyToOne(targetEntity="Village")
	 * @ORM\JoinColumn(name="village_id", referencedColumnName="id")
	 * @var Village
	 */
	private $village;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	private $addressbook;

	/**
	 * @ORM\Column(type="integer")
	 * @var int
	 */
	private $search;


	public function __construct(User $user, Village $village, bool $addressbook, bool $search)
	{
		$this->user = $user;
		$this->village = $village;
		$this->addressbook = $addressbook;
		$this->search = $search;
	}


	public function getUser() : User
	{
		return $this->user;
	}

	public function setUser(User $user) : void
	{
		$this->user = $user;
	}

	public function getVillage() : Village
	{
		return $this->village;
	}

	public function setVillage(Village $village) : void
	{
		$this->village = $village;
	}

	public function getAddressbook() : bool
	{
		return $this->addressbook;
	}

	public function setAddressbook(bool $addressbook) : void
	{
		$this->addressbook = $addressbook;
	}

	public function getSearch() : bool
	{
		return $this->search;
	}

	public function setSearch(bool $search) : void
	{
		$this->search = $search;
	}

}

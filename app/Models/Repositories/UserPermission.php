<?php

declare(strict_types=1);

namespace App\Models\Repositories;

use Kdyby\Doctrine\EntityManager;
use App\Models\Entities;
use Kdyby\Doctrine\EntityRepository;
use Nette;
use Tracy\Debugger;


class UserPermission
{

	const ADDRESSBOOK = true;
	const SEARCH = false;


	const S_ADDRESSBOOK = 'addressbook';
	const S_SEARCH = 'search';

	/** @var EntityManager */
	private $em;

	/** @var EntityRepository */
	private $users;

	/** @var EntityRepository */
	private $villages;

	/** @var EntityRepository */
	private $userAdmins;

	/** @var EntityRepository */
	private $userPermissions;

	public function __construct(EntityManager $em)
	{
		$this->em = $em;
		$this->users = $em->getRepository(Entities\User::class);
		$this->userAdmins = $em->getRepository(Entities\UserAdmin::class);
		$this->villages = $em->getRepository(Entities\Village::class);
		$this->userPermissions = $em->getRepository(Entities\UserPermission::class);
	}

	public function getAllPermissions()
	{
		$villages = $this->villages->findAll();
		$users = $this->users->findAll();

		$userPermissions = $this->userPermissions->findAll();

		return $userPermissions;
	}


	public function set(Entities\User $user, array $permissions) : void
	{
		Debugger::barDump($permissions);

		$addressbookIsUnset = true;
		$searchIsUnset = true;

		foreach ($permissions as $key => $right)
		{
			/* Find out if all values in column are unchecked */
			foreach ($right as $value)
			{
				if ($value)
				{
					if ($key === self::S_ADDRESSBOOK)
					{
						$addressbookIsUnset = false;
					}
					elseif ($key === self::S_SEARCH)
					{
						$searchIsUnset = false;
					}

					break;
				}
			}

			/* Edit records in user_permission table according to filled form */
			foreach ($right as $villageId => $value)
			{
				/** @var Entities\UserPermission $record */
				$record = $this->userPermissions->findOneBy(['user' => $user, 'village' => $this->villages->find($villageId)]);
				//Debugger::barDump($record);

				if ($key === self::S_ADDRESSBOOK)
				{
					$record->setAddressbook($addressbookIsUnset ? true : $value);
				}
				elseif ($key === self::S_SEARCH)
				{
					$record->setSearch($searchIsUnset ? true : $value);
				}

				$this->em->persist($record);
				$this->em->flush($record);
			}
		}
	}

	public function get(Entities\User $user, bool $addressbookOrSearch) : array
	{
		$userAdmin = $this->userAdmins->findby(['user' => $user]);

		/* User is not in user_admin table*/
		if (empty($userAdmin))
		{
			return [];
		}

		$allVillages = $this->villages->findAll();

		$allUserPermissions = $this->userPermissions->findBy(['user' => $user]);

		if ($addressbookOrSearch)
		{
			$permissions = $this->userPermissions->findBy(['user' => $user, 'addressbook' => true]);
		}
		else
		{
			$permissions = $this->userPermissions->findBy(['user' => $user, 'search' => true]);
		}

		$villages = [];

		/* Transform user permissions to array of villages */
		if (!empty($allUserPermissions))
		{
			/** @var Entities\UserPermission $permission */
			foreach ($permissions as $permission) {
				$village = $permission->getVillage();
				$villages[$village->getId()] = $village->getName();
			}
		}

//		Debugger::barDump($allVillages, '$allVillages');
//		Debugger::barDump($allUserPermissions, '$allUserPermissions');
//		Debugger::barDump($permissions, '$permissions');
//		Debugger::barDump($villages, '$villages');
//		exit;

		/* User has permissions set (for addressbook or search) for all villages */
		if (count($allUserPermissions) !== count($allVillages) && count($allUserPermissions) === count($permissions))
		{
			$villages = [];

			/** @var Entities\Village $village */
			foreach ($allVillages as $village) {
				$villages[$village->getId()] = $village->getName();
			}
		}

		return $villages;
	}
}

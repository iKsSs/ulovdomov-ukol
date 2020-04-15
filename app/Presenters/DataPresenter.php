<?php

declare(strict_types=1);

namespace App\Presenters;


use App\Models\Repositories\UserAdmin;
use App\Models\Repositories\User;
use App\Models\Repositories\UserPermission;
use App\Models\Repositories\Village;
use Nette;
use Tracy\Debugger;


final class DataPresenter extends Nette\Application\UI\Presenter
{
	/** @var User */
	private $user;

	/** @var Village */
	private $village;

	/** @var UserAdmin */
	private $userAdmin;

	/** @var UserPermission */
	private $userPermission;

	public function __construct(User $user, Village $village, UserAdmin $userAdmin, UserPermission $userPermission)
	{
		$this->user = $user;
		$this->village = $village;
		$this->userAdmin = $userAdmin;
		$this->userPermission = $userPermission;
	}

	public function renderGet(): void
	{
		$users = $this->user->getAllUsers();
		$villages = $this->village->getAllVillages();
		$userPermissions = $this->userPermission->getAllPermissions();

		$this->template->users = $users;
		$this->template->villages = $villages;
		$this->template->userPermissions = $userPermissions;

		$userIds = [1,2,3,4,5];

		Debugger::barDump('--------------', 'Addressbook');

		foreach ($userIds as $id)
		{
			$testUser = $this->user->getById($id);

			$userPermission = $this->userPermission->get($testUser, UserPermission::ADDRESSBOOK);
			Debugger::barDump($userPermission, $testUser->getName());
		}

		Debugger::barDump('--------------', 'Search');

		foreach ($userIds as $id)
		{
			$testUser = $this->user->getById($id);

			$userPermission = $this->userPermission->get($testUser, UserPermission::SEARCH);
			Debugger::barDump($userPermission, $testUser->getName());
		}
	}


	public function renderSet(): void
	{
		$testUser = $this->user->getById(1);

		$rights = [ 'addressbook' => [ 1 => true, 2 => false ] , 'search' => [ 1 => false, 2 => false ] ];
		//$rights = [ 'addressbook' => [ 1 => false, 2 => true ] , 'search' => [ 1 => true, 2 => false ] ];

		$this->userPermission->set($testUser, $rights);
	}
}

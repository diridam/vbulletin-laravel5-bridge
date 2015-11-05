<?php

namespace diridam\Laravel5VbBridge\Services;

class VBulletinUserDataManager
{
	private $vbulletin;
	private $dataman;

	public function __construct($vbulletin, $dataman) {
		$this->vbulletin = $vbulletin;
		$this->dataman = $dataman;
	}

	public function createUser($username, $email) {
		$new_user = $this->vbulletin->userinfo; // A copy of the array is automatically made
		$this->dataman->set_existing($new_user);
		$this->dataman->set('username', $username);
		$this->dataman->set('usergroupid', 3); // Users awaiting email confirmation
		$this->dataman->set('email', $email);
		// Check for errors
		$this->dataman->pre_save();
		if ($this->dataman->has_errors(false)) {
			\Log::error($this->dataman->errors);
			return false;
		}
		// Once error checking is complete, now save the user
		return $this->dataman->save();
	}

	public function fetchUser($user_id) {
		return fetch_userinfo($user_id);
	}

	public function setExistingUser($user) {
		$this->dataman->set_existing($user);
	}

	public function getUserDataManager() {
		return $this->dataman;
	}
}
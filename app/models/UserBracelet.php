<?php

class UserBracelet extends Eloquent {
	protected $table = 'user_bracelet';

	public function user() {
		return $this->hasMany('User', 'id_user');
	}

	public function bracelet() {
		return $this->hasMany('Bracelet', 'id_bracelet');
	}
}
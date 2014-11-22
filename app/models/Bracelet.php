<?php

	class Bracelet extends Eloquent
	{
		protected $table = 'bracelets';

		public function user()
	    {
	        return $this->belongsTo('User', 'id_user');
	    }
	}
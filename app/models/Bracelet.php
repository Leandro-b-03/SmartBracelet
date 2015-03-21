<?php

	class Bracelet extends Eloquent
	{
		protected $table = 'bracelets';

		public function customer_bracelet()
	    {
	        return $this->hasMany('CustomerBracelet', 'id_bracelet');
	    }
	}
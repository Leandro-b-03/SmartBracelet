<?php

	class CustomerBracelet extends Eloquent
	{
		protected $table = 'customer_bracelet';

		public function user()
	    {
	        return $this->belongsTo('User', 'id_user');
	    }

	    public function bracelet()
	    {
	        return $this->belongsTo('Bracelet', 'id_bracelet');
	    }
	}
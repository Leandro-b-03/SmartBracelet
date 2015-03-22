<?php

	class CustomerBracelet extends Eloquent
	{
		protected $table = 'customer_bracelet';

		public function user()
	    {
	        return $this->belongsToMany('User', 'id_user');
	    }

	    public function bracelet()
	    {
	        return $this->belongsTo('Bracelet', 'id_bracelet');
	    }

	    public function customer()
	    {
	        return $this->belongsTo('Customer', 'id_customer');
	    }
	}
<?php

	class Customer extends Eloquent
	{
		protected $table = 'customers';

		public function order()
	    {
	        return $this->hasMany('Order', 'id_customer');
	    }

		public function bracelet()
	    {
	        return $this->hasMany('Bracelet', 'id_bracelet');
	    }

		public function customer_bracelet()
	    {
	        return $this->hasMany('CustomerBracelet', 'id_customer');
	    }
	}
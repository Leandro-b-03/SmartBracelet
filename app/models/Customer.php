<?php

	class Customer extends Eloquent
	{
		protected $table = 'customers';

		public function order()
	    {
	        return $this->hasMany('Order', 'id');
	    }
	}
<?php

	class Order extends Eloquent
	{
		protected $table = 'orders';

		public function user()
	    {
	        return $this->belongsTo('User', 'id_user');
	    }

		public function customer()
	    {
	        return $this->belongsTo('Customer', 'id_customer', 'id');
	    }

		public function order_bracelet()
	    {
	        return $this->hasMany('OrderBracelet');
	    }
	}
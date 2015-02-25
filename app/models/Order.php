<?php

	class Order extends Eloquent
	{
		protected $table = 'orders';

		public function user()
	    {
	        return $this->belongsTo('User', 'id_user');
	    }

		public function braselet()
	    {
	        return $this->belongsTo('Bracelet', 'id_bracelet');
	    }

		public function custumer()
	    {
	        return $this->belongsTo('Custumer', 'id_custumer');
	    }
	}
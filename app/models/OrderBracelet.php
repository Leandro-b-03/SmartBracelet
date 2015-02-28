<?php

	class OrderBracelet extends Eloquent
	{
		protected $table = 'order_bracelet';

		public function order()
	    {
	        return $this->belongsTo('Order', 'id_order');
	    }

		public function braselet()
	    {
	        return $this->belongsTo('Bracelet', 'id_bracelet');
	    }

		public function product()
	    {
	        return $this->belongsTo('Product', 'id_product');
	    }
	}
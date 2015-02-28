<?php

	class Product extends Eloquent
	{
		protected $table = 'products';

		public function names($value)
	    {
	        return $this->where('name', 'like', $value);
	    }
	}
<?php 
	class AssociateController extends BaseController{
		public function index (){
			return View::make('associate.index');
		}

		public function getCustomersByName (){
			$id = Input::get('id');
			$UserBracelet = CustumerBracelet::all();
			print_r($UserBracelet);
		}
	}
?>
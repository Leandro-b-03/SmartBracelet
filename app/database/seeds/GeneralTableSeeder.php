<?php
class GeneralTableSeeder extends Seeder {

	public function run() {
		DB::table('users')->delete();

		User::create(
			array(
				'username' => 'admin',
				'password' => Hash::make('123456'),
				'name' => 'Administrador',
				'cpf' => '102.761.933-93',
				'rg' => '2.97.726-9',
				'email' => 'Administrador@smartbracelet.com.br',
				'mobile' => '(11) 9654-89789',
				'phone' => '(11) 4242-0244',
				'address' => 'Avenida Pignatari, 635',
			)
		);

		$admin = new Role;
		$admin->name = 'Super Admin';
		$admin->save();

		$manageUsers = new Permission;
		$manageUsers->name = 'manage_standard_users';
		$manageUsers->display_name = 'Gerencia Usuários';
		$manageUsers->save();

		$manageCustumers = new Permission;
		$manageCustumers->name = 'manage_standard_customers';
		$manageCustumers->display_name = 'Gerencia Clientes';
		$manageCustumers->save();

		$manageOrders = new Permission;
		$manageOrders->name = 'manage_standard_orders';
		$manageOrders->display_name = 'Gerencia Pedidos';
		$manageOrders->save();

		$manageProducts = new Permission;
		$manageProducts->name = 'manage_standard_products';
		$manageProducts->display_name = 'Gerencia Produtos';
		$manageProducts->save();

		$manageBracelets = new Permission;
		$manageBracelets->name = 'manage_standard_bracelets';
		$manageBracelets->display_name = 'Gerencia Pulseiras';
		$manageBracelets->save();

		$admin->perms()->sync(
			array(
				$manageUsers->id,

				$manageCustumers->id,

				$manageOrders->id,

				$manageProducts->id,

				$manageBracelets->id
			)
		);

		$user = User::where('username', '=', 'admin')->first();
		$user->attachRole($admin);

		Product::create(
			array(
				'name' => 'Red Label',
	            'price' => '70.00',
	            'quantity' => '1000',
	            'image' => 'source/redlabel.jpg',
	            'status' => '1',
			)
		);
		Product::create(
			array(
				'name' => 'Black Label',
	            'price' => '139.99',
	            'quantity' => '1000',
	            'image' => 'source/blacklabel.jpg',
	            'status' => '1',
			)
		);
		Product::create(
			array(
				'name' => 'Green Label',
	            'price' => '259.99',
	            'quantity' => '1000',
	            'image' => 'source/greenlabel.jpg',
	            'status' => '1',
			)
		);
		Product::create(
			array(
				'name' => 'Gold Label',
	            'price' => '379.00',
	            'quantity' => '1000',
	            'image' => 'source/goldlabel.jpg',
	            'status' => '1',
			)
		);
		Product::create(
			array(
				'name' => 'Blue Label',
	            'price' => '600.00',
	            'quantity' => '500',
	            'image' => 'source/bluelabel.jpg',
	            'status' => '1',
			)
		);

		Bracelet::create(
			array(
				'tag' => strtoupper(substr(md5(mt_rand()), 12)),
				'color' => 'Azul',
			)
		);
		Bracelet::create(
			array(
				'tag' => strtoupper(substr(md5(mt_rand()), 12)),
				'color' => 'Azul',
			)
		);
		Bracelet::create(
			array(
				'tag' => strtoupper(substr(md5(mt_rand()), 12)),
				'color' => 'Verde',
			)
		);
		Bracelet::create(
			array(
				'tag' => strtoupper(substr(md5(mt_rand()), 12)),
				'color' => 'Verde',
			)
		);
		Bracelet::create(
			array(
				'tag' => strtoupper(substr(md5(mt_rand()), 12)),
				'color' => 'Vermelho',
			)
		);
		Bracelet::create(
			array(
				'tag' => strtoupper(substr(md5(mt_rand()), 12)),
				'color' => 'Vermelho',
			)
		);
		Bracelet::create(
			array(
				'tag' => strtoupper(substr(md5(mt_rand()), 12)),
				'color' => 'Amarelo',
			)
		);
		Bracelet::create(
			array(
				'tag' => strtoupper(substr(md5(mt_rand()), 12)),
				'color' => 'Amarelo',
			)
		);
		Bracelet::create(
			array(
				'tag' => strtoupper(substr(md5(mt_rand()), 12)),
				'color' => 'Roxo',
			)
		);
		Bracelet::create(
			array(
				'tag' => strtoupper(substr(md5(mt_rand()), 12)),
				'color' => 'Roxo',
			)
		);
		Bracelet::create(
			array(
				'tag' => strtoupper(substr(md5(mt_rand()), 12)),
				'color' => 'Rosa',
			)
		);
		Bracelet::create(
			array(
				'tag' => strtoupper(substr(md5(mt_rand()), 12)),
				'color' => 'Rosa',
			)
		);
	}

}
?>
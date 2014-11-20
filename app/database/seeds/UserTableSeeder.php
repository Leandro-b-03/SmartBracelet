<?php
class UserTableSeeder extends Seeder {

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
	}

}
?>
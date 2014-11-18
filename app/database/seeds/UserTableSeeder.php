<?php
class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('user')->delete();

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
				'address' => 'Avenida Pignatari, 635'
			)
		);
    }

}
?>
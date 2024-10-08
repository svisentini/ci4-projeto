<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuarioFakerSeeder extends Seeder
{
    public function run()
    {
        $usuarioModel = new \App\Models\UsuarioModel();
        // use the factory to create a Faker\Generator instance
        $faker = \Faker\Factory::create();
        $criarQuantosUsuarios = 5000;
        $usuariosPush = [];

        for($i = 0; $i < $criarQuantosUsuarios; $i++){

            array_push($usuariosPush,[
                'nome' => $faker->unique()->name,
                'email' => $faker->unique()->email,
                'password_hash' => '123456', // Ainda nao conhecemos hash de senhas (criptografia)
                'ativo' => $faker->numberBetween(0, 1), // Variando valores entre 0 e 1, ou seja, True ou False
            ]);
        }

        // echo '<pre>';
        // print_r($usuariosPush);
        // exit;

        $usuarioModel->skipValidation(true) // Pula as validações
                     ->protect(false)  // false >> Não valida os allowedFields
                     ->insertBatch($usuariosPush);
        
        echo "$criarQuantosUsuarios usuários criados com Sucesso !"; 
    }
}

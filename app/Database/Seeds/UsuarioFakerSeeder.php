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
        $criarQuantosUsuarios = 50;
        $usuariosPush = [];

        for($i = 0; $i < $criarQuantosUsuarios; $i++){

            array_push($usuariosPush,[
                'nome' => $faker->unique()->name,
                'email' => $faker->unique()->email,
                'password_hash' => '123456', // Ainda nao conhecemos hash de senhas (criptografia)
                'ativo' => true,
            ]);
        }

        // echo '<pre>';
        // print_r($usuariosPush);
        // exit;

        $usuarioModel->skipValidation(true) // Pula as validações
                     ->protect(false)  // Não valida os allowedFields
                     ->insertBatch($usuariosPush);
        
        echo "$criarQuantosUsuarios usuários criados com Sucesso !"; 
    }
}

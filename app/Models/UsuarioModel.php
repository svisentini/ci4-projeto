<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $table            = 'usuarios';

    protected $returnType       = 'App\Entities\Usuario';
    protected $useSoftDeletes   = true;
    protected $allowedFields    = [
        'nome',
        'email',
        'password',
        'reset_hash',
        'reset_expira_em',
        'imagem',
        // Nao colocaremos o campo ativo, pois existe a manipulação de formulario.
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true; // true >> campos criado_em, atualizado_em e deletado_em sao preenchidos automaticamente

    protected $createdField  = 'criado_em';
    protected $updatedField  = 'atualizado_em';
    protected $deletedField  = 'deletado_em';

    // Validation
    protected $validationRules = [
        'id'            => 'permit_empty|is_natural_no_zero', // <-- ESSA LINHA DEVE SER ADICIONADA
        'nome'          => 'required|max_length[120]|min_length[3]',
        'email'         => 'required|max_length[230]|valid_email|is_unique[usuarios.email,id,{id}]', // EMAIL unico para aquele ID >> para permitir alterar.
        'password'      => 'required|max_length[255]|min_length[6]',
        'password_confirmation'  => 'required_with[password]|max_length[255]|matches[password]',
    ];
    protected $validationMessages = [
        'nome' => [
            'required' => 'O campo "Nome Completo" é obrigatório.',
            'min_length' => 'O campo "Nome Completo" precisa ter pelo menos 3 caracteres.',
        ],
        'email' => [
            'required' => 'O campo "E-mail" é obrigatório.',
            'is_unique' => 'Esse e-mail ja esta cadastrado. Informe outro.',
        ],
        'password_confirmation' => [
            'matches' => 'As senhas estão diferentes.',
        ],
        
    ];

    // Callbacks
    protected $beforeInsert   = ['hashPassword'];
    protected $beforeUpdate   = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        // Se o campo password esta setado
        if (isset($data['data']['password'])) {
            // Cria password_hash em data com o hash de password
            $data['data']['password_hash'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);

            // Remove dos dados a serem salvos
            unset($data['data']['password']);
            unset($data['data']['password_confirmation']);
        }
        return $data;
    }

}

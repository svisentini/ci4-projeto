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
    protected $validationRules      = [];
    protected $validationMessages   = [];

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

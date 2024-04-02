<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Usuarios extends BaseController
{
    private $usuarioModel;

    public function __construct()
    {
        $this->usuarioModel = new \App\Models\UsuarioModel();
    }

    public function index()
    {
        $data = [
            'titulo' => 'Listando os Usuários do Sistema',
        ];

        return view ('Usuarios/index', $data);

    }

    public function recuperaUsuarios(){
        // if (!$this->request->isAJAX()){
            // return redirect()->back();
        // }
        
        $atributos = [
            'id',
            'nome',
            'email',
            'ativo',
            'imagem',
        ];
        $usuarios = $this->usuarioModel->select($atributos)
                                        ->findAll();

        // Recebera o array de objetos de Usuários
        $data = [];

        foreach($usuarios as $usuario){
            $data[] = [
                'imagem' => $usuario->imagem,
                'nome' => esc($usuario->nome),
                'email' => esc($usuario->email),
                'ativo' => ($usuario->ativo == true ? 'Ativo' : '<span class="text-warning">Inativo</span>' ),

            ];
        }

        $retorno = [
            'data' => $data,
        ];

        // echo '<pre>';
        // print_r($retorno);
        // exit;

        return $this->response->setJSON($retorno);

    }
}

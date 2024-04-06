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
                'nome' => anchor("usuarios/exibir/$usuario->id", esc($usuario->nome), 'title="Exibir usuário : '.esc($usuario->nome).'"'),
                'email' => esc($usuario->email),
                'ativo' => ($usuario->ativo == true ? '<i class="fa fa-unlock text-success"></i>&nbsp;Ativo' : '<i class="fa fa-lock text-warning"></i>&nbsp;Inativo' ),

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

    public function exibir (int $id = null){
        $usuario = $this->buscaUsuarioOu404($id);

        //dd($usuario);

        $data = [
            'titulo' => "Detalhando o usuário ".esc($usuario->nome),
            'usuario' => $usuario,
        ];
        return view('Usuarios/exibir', $data);
    }

    /**
     * Metodo que recupera o usuário
     * @param integer $id
     * @return Exceptions|object
     */
    private function buscaUsuarioOu404(int $id = null){
        // Se o id nao foi informado ou nao foi encontrado na base de dados....
        // Se encontrar, $usuario ja estara populada com o usuario encontrado.
        if (!$id || !$usuario = $this->usuarioModel->withDeleted(true)->find($id) ){
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o usuário $id");
        }
        return $usuario;
    }

}

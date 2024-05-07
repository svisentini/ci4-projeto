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

        return view('Usuarios/index', $data);
    }

    // ----------------------------------------------------------------------------------
    // --------- recuperar usuario ------------------------------------------------------
    // ----------------------------------------------------------------------------------

    public function recuperaUsuarios()
    {
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

        foreach ($usuarios as $usuario) {

            $data[] = [
                'imagem' => $usuario->imagem,
                'nome' => anchor("usuarios/exibir/$usuario->id", esc($usuario->nome), 'title="Exibir usuário : ' . esc($usuario->nome) . '"'),
                'email' => esc($usuario->email),
                'ativo' => ($usuario->ativo == true ? '<i class="fa fa-unlock text-success"></i>&nbsp;Ativo' : '<i class="fa fa-lock text-warning"></i>&nbsp;Inativo'),

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

    // -----------------------------------------------------------------------
    // --------- exibir ------------------------------------------------------
    // -----------------------------------------------------------------------

    public function exibir(int $id = null)
    {
        $usuario = $this->buscaUsuarioOu404($id);

        // dd($usuario);

        $data = [
            'titulo' => "Detalhando o usuário >> " . esc($usuario->nome),
            'usuario' => $usuario,
        ];
        return view('Usuarios/exibir', $data);
    }

    // -----------------------------------------------------------------------
    // --------- editar ------------------------------------------------------
    // -----------------------------------------------------------------------

    public function editar(int $id = null)
    {
        $usuario = $this->buscaUsuarioOu404($id);

        // dd($usuario);

        $data = [
            'titulo' => "Editando o usuário >> " . esc($usuario->nome),
            'usuario' => $usuario,
        ];
        return view('Usuarios/editar', $data);
    }

    // -----------------------------------------------------------------------
    // --------- atualizar ---------------------------------------------------
    // -----------------------------------------------------------------------

    public function atualizar()
    {
        // Aceita apenas requisições Ajax
        if (!$this->request->isAJAX()) {
            return redirect()->back();
        }

        // Envio o hash do token do form
        $retorno['token'] = csrf_hash();
        //$retorno['info'] = "Essa é uma mensagem de informação";
        //$retorno['erro'] = "Essa é uma mensagem de erro de validação";
        //$retorno['erros_model'] = [
        //    'nome' => 'O nome é obrigatório',
        //    'email' => 'Email inválido',
        //    'password' => 'A senha é muito curta',
        //];

        // Recupera todas informações do Post da Requisição
        $post = $this->request->getPost();

        // Validando a existencia do Usuario
        $usuario = $this->buscaUsuarioOu404($post['id']);

        // Se nao foi informada a senha, removemos os campos do $post
        // Se nao fizermos isso, o hashPassword fara o hash de uma string vazia !! 
        if (empty($post['password'])) {
            // Remove o atributo passwod >> bypass temporario 
            unset($post['password']);
            unset($post['password_confirmation']);
        }

        // Preenchemos os atributos do usuario com os valores do post
        $usuario->fill($post);

        // Verificar se houve alguma alteração
        if ($usuario->hasChanged() == false) {
            $retorno['info'] = 'Não há dados para serem atualizados !';
            return $this->response->setJSON($retorno);
        }

        // Tem que desabilitar a proteção para conseguir salvar o campo ativo
        if ($this->usuarioModel->protect(false)->save($usuario)) {
            // VAMOS CONHECER MENSAGENS DE FLASH DATA
            return $this->response->setJSON($retorno);
        }

        // Retornamos os erros de validação
        $retorno['erro'] = 'Verifique os erros abaixo e tente novamente';
        $retorno['erros_model'] = $this->usuarioModel->errors();



        // Retorno para o Ajax Request
        return $this->response->setJSON($retorno);

        // Precisa fazer dessa forma pois o dd nao funciona em metodos chamados pelo ajax.
        //echo '<pre>';
        //print_r($post);
        //exit;
    }

    // -----------------------------------------------------------------------
    // --------- busca usuario -----------------------------------------------
    // -----------------------------------------------------------------------

    /**
     * Metodo que recupera o usuário
     * @param integer $id
     * @return Exceptions|object
     */
    private function buscaUsuarioOu404(int $id = null)
    {
        // Se o id nao foi informado ou nao foi encontrado na base de dados....
        // Se encontrar, $usuario ja estara populada com o usuario encontrado.
        if (!$id || !$usuario = $this->usuarioModel->withDeleted(true)->find($id)) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Não encontramos o usuário $id");
        }
        return $usuario;
    }
}

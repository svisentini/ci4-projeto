# ci4-ordem
Curso da Udemy 

# ORDEM (Udemy)

composer create-project codeigniter4/appstarter ci4-ordem

composer clearcache
composer update

php spark serve

# Renomear arquivo "env" para ".env"
	setar baseURL
	Alterar CI_ENVIRONMENT para development 	>> Dessa forma, os erros sao exibidos no browser
	
# No arquivo routing.php
	Alterar propriedade $autoRoute = true; 		>> Para que os controllers e os metodos possam ser encontrados.

# Controler
	Cria um novo controller						>> php spark make:controller
    												Teste
	Endereço/<Controller>/<metodo>
	
	Listar todos					>> $corModel->findAll(),
	Filtrar com "where"				>> $corModel->where('ativa', true)->findAll(),
	Listar apenas 2 registros		>> $corModel->findAll(2),

# PHP My Admin
	sudo /opt/lampp/manager-linux-x64.run 	>> Para rodar o Xammp
	sudo /opt/lampp/xampp start				>> Start Xammp
	http://localhost:81/phpmyadmin/       OU  http://localhost/phpmyadmin/
	utf8mb4_general_ci

	database.default.hostname = 127.0.0.1
	database.default.database = teste-ci4

	php spark migrate >> Cria a tabela de migrações (se nao tiver) e roda todas migrações
	
# Migration
	Ref: https://codeigniter.com/user_guide/dbmgmt/migration.html 
	Criar o arquivo de migration         		>> php spark make:migration <nome da migration>
	Rodar as migrações                   		>> php spark migrate
	Verificar as migrações executadas    		>> php spark migrate:status
	Rollback do ultimo batch da migração 		>> php spark migrate:rollback
	Rollback de TUDO e migrate TUDO denovo  	>> php spark migrate:refresh
	Rollback para um determinado batch			>> php spark migrate:rollback -b <numero do batch>
	
# Modelo
	Ref: https://codeigniter.com/user_guide/models/model.html
	Um Modelo representa uma tabela no Banco de Dados.
	Criar o modelo >> php spark make:model CorModel
	
# Database Seeding
	Ref: https://codeigniter.com/user_guide/dbmgmt/seeds.html?highlight=seeding
	php spark make:seeder CorSeeder 
	php spark make:seeder CentralSeeder    >> Sera usado como um Seeder central --> Chamara os outros seeders
	
	Para rodar um Seeder >> php spark db:seed CentralSeeder
	
# Exemplos de HTML
	Ref: https://www.w3schools.com/html

# Pagina de Templates
	https://www.templateshub.net/
	Dark Admin Bootstrap 4 PREMIUM Free Download
	
	As pastas devem ser copiadas para dentro do projeto na pasta public/recursos
	
	<?php echo site_url() ?>      >> site_url aponta para a pasta "public"

# Criando layouts para serem estendidos pelas views
	Referencia
		https://codeigniter.com/user_guide/outgoing/view_layouts.html
	Pontos de inserção de codigo
		<?php echo $this->renderSection('conteudo'); ?>
	Exibição do ano da data atual
		<?php echo date('Y'); ?>

# Utilizando layout criado
	Referencia
		https://codeigniter.com/user_guide/outgoing/view_layouts.html
	Extendendo de um layout
		<?= $this->extend('Layout/principal') ?>
	Criando as sessões
		<?= $this->section('titulo') ?>
			<?php echo $titulo; ?>
		<?= $this->endSection() ?>

# Módulo de Usuários
	Criar o banco de dados
		php spark db:create ordem
	Configurar projeto para utilizar novo banco de dados
		.env
		database.default.database = ordem
	Criar a tabela de migrações
		php spark migrate
	Criar as migrações para Usuários
		php spark make:migration cria_tabela_usuarios
		Criar PK
			$this->forge->addKey
		Criar Chave Unica
			$this->forge->addUniqueKey
	Rodar a migração
		php spark migrate
	Status 
		php spark migrate:status
	Criando Controller e Modelo de Usuarios
		php spark make:model UsuarioModel
		php spark make:controller Usuarios
		
	Semeando a tabela de usuarios com dados "fake"
		faker fzaninotto (Ja vem quando instalamos o codeigniter utilizando o composer)
		php spark make:seeder UsuarioFakerSeeder
		php spark db:seed UsuarioFakerSeeder
	
	Instalando o plugin Datatable na nossa aplicação
		https://datatables.net/
		
	Utilizando Ajax para recuperar as informações >> Devido a grande quantidade de informações... melhoria de performance
	
	esc() >> Coloca escape de caracteres para nao quebrar o layout
	http://localhost:8080/usuarios/recuperaUsuarios
	http://localhost:8080/usuarios
	
	Tradução do DataTable
		Infomações >> https://datatables.net/reference/option/language
		Chaves em Portugues >> https://datatables.net/plug-ins/i18n/Portuguese-Brasil.html
	
	deferRender >> Performance para grande quantidade de registros na DataTable
		https://datatables.net/reference/option/deferRender
		
	Tipos de Paginação
		https://datatables.net/reference/option/pagingType
		
	Criando mais registros para testes
		Arquivo alterado : UsuarioFakerSeeder
		php spark migrate:rollback				>> Irá excluir a tabela de usuários
		php spark migrate						>> Criara a tabela de usuarios, porem sem registros
		php spark db:seed UsuarioFakerSeeder    >> Insere registros na tabela de usuarios.
		






	
	
	
	
	
	
	
	
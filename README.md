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

Pagina de Templates
	https://www.templateshub.net/
	Dark Admin Bootstrap 4 PREMIUM Free Download
	
	As pastas devem ser copiadas para dentro do projeto na pasta public/recursos
	
	<?php echo site_url() ?>      >> site_url aponta para a pasta "public"










	
	
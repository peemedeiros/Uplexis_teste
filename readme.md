# Uplexis Teste

## Configurando ambiente - Linux Ubuntu 18.04:

### Instale apache2 e o php7.3 e extensões que serão necessárias:

#sudo add-apt-repository ppa:ondrej/php

---

#sudo apt-get update

---

#sudo apt-get install apache2 libapache2-mod-php7.3 php7.3 php7.3-xml php7.3-gd php7.3-opcache php7.3-mbstring php7.3-mysql

---
#sudo systemctl start apache2.service

### Instale o MySQL

#sudo apt update

---

#sudo apt install mysql-server

---

#sudo mysql_secure_installation

### Instale o composer com os seguintes comandos no terminal:

#sudo apt update

---

#sudo apt install wget php-cli php-zip unzip

---

php -r "copy('[https://getcomposer.org/installer](https://getcomposer.org/installer)', 'composer-setup.php');"

---

HASH="$(wget -q -O - [https://composer.github.io/installer.sig](https://composer.github.io/installer.sig))"

---

php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"

A saída do comando acima deve ser:

Installer verified

---

#sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer

---

Teste a instalação com o comando:

composer

---

### Instale o Laravel Installer

#sudo composer global require laravel/installer

# **Iniciando projeto**

1. Clone o projeto [https://github.com/peemedeiros/Uplexis_teste](https://github.com/peemedeiros/Uplexis_teste)
2. Crie um banco de dados chamado 'uplexis'
3. Entre na pasta do projeto e configure o arquivo de ambiente('.env') de acordo com suas credencias de acesso ao banco de dados mysql;
4. Ainda na pasta do projeto execute a instalação dos pacotes utilizado no projeto com o comando "composer install"
5. Após concluida a instalação execute o comando "php artisan migrate" para criar as tabelas no banco de dados
6. Realizadas as migrações, inicie o servidor com 'php artisan serve'
7. Acesse o link do projeto.
8. Registre um novo usuario.
9. Use o email e senha para autenticar

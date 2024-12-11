# Projet E-commerce Laravel

Ce projet est une application de gestion de produits, panier d'achat et liste d'envies, développée avec Laravel.

## Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- [PHP](https://www.php.net/) (version 8.0 ou supérieure)
- [Composer](https://getcomposer.org/)
- [MySQL](https://www.mysql.com/)
- [Laravel](https://laravel.com/)
- [MAMP](https://www.mamp.info/) (ou un serveur local similaire)

## Installation

# 1. Clonez le projet

git clone https://github.com/zakariadbani/ecommerce_laravel.git

#   2. Installez les dépendances via Composer
### Naviguez dans le dossier du projet et exécutez la commande suivante :

cd ecommerce_laravel
composer install

# 3. Configurez votre fichier .env
### Copiez le fichier .env.example et renommez-le en .env :

cp .env.example .env

### Modifiez ensuite les informations de votre base de données dans le fichier .env :

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=votre_base_de_donnees
DB_USERNAME=votre_utilisateur
DB_PASSWORD=votre_mot_de_passe

### Si vous utilisez MAMP, vous pouvez avoir besoin de spécifier le socket :
DB_SOCKET=/Applications/MAMP/tmp/mysql/mysql.sock


# 4. Générez la clé de l'application
### Exécutez la commande suivante pour générer la clé de votre application Laravel :

php artisan key:generate

# 5. Exécutez les migrations
### Pour créer les tables dans la base de données, exécutez les migrations :

php artisan migrate

# 6.Chargement des données de test
### Si vous souhaitez ajouter des données de test à votre application, vous pouvez exécuter le seeder suivant :

php artisan db:seed

# 7.Générer la documentation Swagger

php artisan l5-swagger:generate

# 8.Lancer l'application
### Cela lancera votre application sur http://127.0.0.1:8000 (ou l'adresse indiquée dans la sortie du terminal).

php artisan serve

# 9.Accéder à la documentation
### Vous pouvez accéder à la documentation de l'API à l'adresse suivante dans votre navigateur :

http://127.0.0.1:8000/api/documentation


# 10.NB : Création automatique d'utilisateurs avec Seeder

### Lorsque vous exécutez le seeder, ces deux utilisateurs seront automatiquement ajoutés à votre base de données.

####      Administrateur
          Email : admin@admin.com
          Mot de passe : password
####      Utilisateur classique
          Email : user@example.com
          Mot de passe : password


### En plus des utilisateurs par défaut, 12 produits sont également créés automatiquement lors de l'exécution des seeders.

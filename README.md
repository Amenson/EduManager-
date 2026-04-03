# Scolarite Project

Application Laravel de gestion scolaire pour administrer :

- les eleves
- les classes
- les matieres
- les notes
- les absences
- les paiements

## Fonctionnalites

- authentification simple par email et mot de passe
- gestion des eleves cote administrateur
- gestion des classes, matieres et utilisateurs
- tableau de bord avec statistiques
- saisie des notes pour les enseignants
- gestion des absences
- consultation des notes et bulletins pour les eleves
- enregistrement et consultation des paiements
- rapport financier de base

## Stack technique

- Laravel 8
- PHP 8.2 recommande
- MySQL
- Bootstrap 5 via CDN
- WAMP sous Windows

## Prerequis

- WAMP installe
- MySQL demarre
- PHP WAMP disponible ici :

```powershell
C:\wamp64\bin\php\php8.2.29\php.exe
```

## Installation

Placez-vous dans le dossier du projet :

```powershell
cd C:\wamp64\www\Scolarité\Scolarité-project
```

Installez les dependances si besoin :

```powershell
composer install
npm install
```

## Configuration

Le fichier [`.env`](/c:/wamp64/www/Scolarité/Scolarité-project/.env) est configure pour MySQL local :

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=gestion_scolarite
DB_USERNAME=root
DB_PASSWORD=
```

Assurez-vous que la base `gestion_scolarite` existe dans MySQL.

Si besoin, creez-la depuis MySQL ou phpMyAdmin.

## Migrations et seed

Pour reconstruire proprement la base :

```powershell
& 'C:\wamp64\bin\php\php8.2.29\php.exe' artisan migrate:fresh --seed --force
```

Pour lancer simplement les migrations :

```powershell
& 'C:\wamp64\bin\php\php8.2.29\php.exe' artisan migrate --seed
```

## Lancer le projet

Demarrer le serveur Laravel :

```powershell
& 'C:\wamp64\bin\php\php8.2.29\php.exe' artisan serve --host=127.0.0.1 --port=8000
```

Ouvrir ensuite :

```text
http://127.0.0.1:8000
```

## Compte administrateur par defaut

Le seeder cree un compte admin :

- Email : `admin@scolarite.test`
- Mot de passe : `password`

## Tests

Lancer les tests :

```powershell
& 'C:\wamp64\bin\php\php8.2.29\php.exe' vendor\phpunit\phpunit\phpunit --colors=never
```

## Structure utile

- `app/Http/Controllers` : controleurs
- `app/Models` : modeles Eloquent
- `app/Services` : logique metier
- `app/Http/Requests` : validation
- `database/migrations` : schema SQL
- `database/seeders` : donnees initiales
- `resources/views` : vues Blade
- `routes/web.php` : routes web

## Notes importantes

- Sur cette machine, la commande `php` seule ne fonctionne pas toujours dans PowerShell.
- Utilisez de preference le chemin complet du binaire PHP WAMP.
- Le projet a ete corrige pour que les routes, migrations, seeders et tests de base fonctionnent.

## Commandes utiles

Vider les caches Laravel :

```powershell
& 'C:\wamp64\bin\php\php8.2.29\php.exe' artisan config:clear
& 'C:\wamp64\bin\php\php8.2.29\php.exe' artisan cache:clear
& 'C:\wamp64\bin\php\php8.2.29\php.exe' artisan route:clear
& 'C:\wamp64\bin\php\php8.2.29\php.exe' artisan view:clear
```

Voir les routes :

```powershell
& 'C:\wamp64\bin\php\php8.2.29\php.exe' artisan route:list
```

email : admin@scolarite.test
mot de passe : password

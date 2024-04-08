 REndu Magodo_Dankwah : Le guide d'installation de votre projet 
 
Guide d'installation pour le projet utilisant npm
1. Clonez ce référentiel sur votre machine locale :
git clone https://github.com/MIASHS-UGA-PWS/pws-projet-2024-recettes-magodo_dankwah.git
2. Ouvrez Git Bash.
3. Accédez au répertoire du projet : cd pws-projet-2024-recettes-magodo_dankwah 
4. Installez les dépendances du projet en utilisant le gestionnaire de paquets npm : npm install
5. Configurez les fichiers nécessaires (par exemple, les fichiers de configuration, les fichiers .env, etc.) en suivant les instructions fournies dans les fichiers de configuration correspondants.
6. Lancez l'application en exécutant la commande suivante : npm start. Cela démarrera l'application et vous pourrez y accéder dans votre navigateur à l'adresse http://localhost:3000.


Guide d'installation pour le projet utilisant PHP et Composer :
- Cloner le référentiel du projet depuis GitHub : git clone <https://github.com/MIASHS-UGA-PWS/pws-projet-2024-recettes-magodo_dankwah.git>
- Accéder au répertoire du projet : cd <pws-projet-2024-recettes-magodo_dankwah>
- Installer les dépendances PHP à l'aide de Composer : composer install
- Installer les dépendances JavaScript à l'aide de npm : npm install
- Copier le fichier .env.example et le renommer en .env : cp .env.example .env
- Modifier le fichier .env avec les informations de configuration spécifiques à votre environnement 
- Exécuter les migrations de la base de données pour créer les tables nécessaires : php artisan migrate
- Lancer le serveur de développement : php artisan serve
- Accédez à l'URL du serveur de développement dans votre navigateur pour accéder au projet.


## Recettes

Le site est composé de :

- Une page d'accueil affichant un texte de bienvenue et les 3
  dernières recettes
- La page recettes, qui affichent une liste de toutes les recettes
  avec une barre de recherche
- La page d'une recette, affichée après avoir été cliquée sur l'un
  d'eux dans la liste.
- Une page de contact avec un formulaire

Fonctionnalités supplémentaires
- Gestion des commentaires
- Notes




## Mise en place du projet

Exercice 3.1 - Créer un contrôleur basique
· Ouvrez le fichier routes/web.php, commenter le code et ajoutez le code suivant : use App\Http\Controllers\HomeController;
Route::get('/', [HomeController::class, 'index']);
Lorsqu’un visiteur du site arrive sur l’URL “/”, appelle la fonction index du contrôleur qui s’appelle HomeController.
· Créer le contrôleur Home: << php artisan make:controller HomeController>> le répertoire app/Http/Controllers

· Éditez ce fichier, créez une fonction “index” et placez ce code suivant à l’intérieur de la fonction: return view('welcome');

Exercice 3.2 - Créer un layout global pour les vues
· Créez le fichier resources/views/layouts/main.blade.php
· Placez le code suivant dans ce fichier : https://gist.github.com/flody/3625983302dbb07716350e0b2a96e240
Le layout est maintenant créé.
· Modifiez le fichier resources/views/welcome.blade.php avec ces codes pour utiliser votre layout. Utiliser le code blade suivant: @extends('layouts/main') pour déclarer que la vue doit utiliser ce layout
· Déclarer une section blade:

@section('content')
<h1>Home content</h1>
@endsection

La section content sera affichée dans le fichier layout à l’endroit où est placé le code: @yield('content')
Modifiez le fichier routes/web.php pour prendre en compte ces deux nouvelles URLs (recettes et Contact). Par exemple : 
use App\Http\Controllers\ContactController;
Route::get('/contact', [ContactController::class, 'index']);
Créez 2 contrôleurs, un pour recettes et un pour contact: php artisan make:controller 
Créez 2 vues pour les fonctions d’index des contrôleurs recipe et contact qui utilisent le layout principal.
Pour la page home, prendre dans le layout le code en commentaire affichant 3 recettes et l’inclure dans le @section('content') de la page home. Supprimer le code en commentaire. Modifiez le fichier resources/views/welcome.blade.php avec ce code pour utiliser le layout
Modifiez le fichier routes/web.php pour prendre en compte de nouvelles URLs recettes et Contact. 
use App\Http\Controllers\ContactController;
Route::get('/contact', [ContactController::class, 'index']);
Créez 2 contrôleurs, un pour recettes et un pour contact avec la commande php artisan make:controller 
Créez 2 vues pour les fonctions d’index des contrôleurs recipe et contact qui utilisent le layout principal.
Pour la page home, prendre dans le layout le code en commentaire affichant 3 recettes et l’inclure dans le  @section('content') de la page home. 

4 - Base de données
Avec SQLite:
Créez un fichier database.sqlite dans le répertoire database/ de l’application
Modifiez le fichier .env pour spécifier l’utilisation de SQLite et le chemin d’accès au fichier: 
DB_CONNECTION=sqlite
DB_DATABASE= /workspaces/pws-projet-2024-recettes-magodo_dankwah database/database.sqlite
//rest of database code
Lancez: php artisan migrate

Exercice 4.1 - Créer les tables recipes, contacts et comments
create_recipes_table : php artisan make:migration create_recipes_table --create=recipes
create_contacts_table : php artisan make:migration create_contacts_table --create=contacts
create_comments_table : php artisan make:migration create_comments_table --create=comments

Lancer une migration: php artisan migrate:fresh

5 - Création des modèles et utilisation d’Eloquent
Créez 3 modèles Recipe, Contact et Comment : php artisan make:model Recipe
php artisan make:model Contact
php artisan make:model Comment

Modifiez les 3 migrations pour ajouter toutes les colonnes présentes dans le schéma de base de données (pour les tables recipes, contacts et comments). 

Relancer une migration: php artisan migrate:fresh

Exercice 5.2 - Lier les modèles User et Recipe
Dans notre site, une recette appartient à un user, et un user possède zéro ou plusieurs recettes.

Pour renseigner cette relation, ajouter la fonction suivante dans le modèle User:

   /**
    * Get the user recipes'
    */
   public function recipes()
   {
       return $this->hasMany(Recipe::class,'owner_id');
   }

et la fonction suivante dans le modèle recipe:

   /**
    * Get the user that owns the recipe.
    */
   public function user()
{
       return $this->belongsTo(User::class,'owner_id');
   }

À partir de maintenant, il est possible de récupérer le propriétaire d’une recette ou bien les recettes d’un utilisateur facilement:

$recipe = \App\Models\Recipe::find(1); //trouver la recette avec l’id 1
echo $recipe->user->name; //affiche le nom du propriétaire

$recipes = \App\Models\User::find(1)->recipes; //get recipes from user id 1
foreach ($recipes as $recipe) {
   //loop on recipes

Exercice 5.3 - Ajout de données
- Créer une Factory pour recipe: php artisan make:factory RecipeFactory --model=Recipe
- Compléter la fonction definition() avec les colonnes de la table recipes 
use Faker\Generator as Faker;...

Dans database/seeders/DatabaseSeeder.php, générer des utilisateurs avec des recipes avec le code suivant :

-Créer automatiquement plusieurs recettes (au moins 10) lié à plusieurs users grâce à la commande:

php artisan migrate:fresh --seed -v

Dans la méthode run() de la classe DatabaseSeeder
use App\Models\User;
use App\Models\Recipe;
 
public function run()
{
    User::factory()->count(10)->create()->each(function ($user) {
        $user->recipes()->saveMany(Recipe::factory()->count(3)->make());
    });
}

Exercice 5.3 - Afficher la liste de recettes sur la page d’accueil
· Dans le controller HomeController , ajouter le code: use App\Models\Recipe;
 public function index()
{
    $recipes = Recipe::all();
 
    return view('welcome', [
        'recipes' => $recipes
    ]);
}
· Ouvrir "resources/views/ welcome.blade.php "
· Ajouter le code : <ul>
@foreach ($recipes->take(3)->reverse() as $recipe)
  <li><a href="{{ url('/recettes/' . $recipe->url) }}">{{ $recipe->title }}</a></li>
@endforeach
</ul> a 

Exercice 6 - Afficher une recette
· Créer une nouvelle route dans le fichier routes/web.php:

· Créez une nouvelle vue single.blade.php dans le répertoire resources/views/recipes/. Cette vue contient le code HTML nécessaire pour afficher les détails de la recette. Vous pouvez réutiliser le code HTML de la template originale. Dans la vue single.blade.php, utilisez la variable $recipe pour afficher les détails de la recette. Par exemple, pour afficher le nom du propriétaire de la recette, vous pouvez utiliser $recipe->owner_name.
html <h1>Nom du propriétaire : {{ $recipe->owner_name }}</h1>

Dans le controller recipesController , exploiter le paramètre de l’url :

   public function show($recipe_url) {
       $recipe = \App\Models\Recipe::where('url',$recipe_url)->first(); //get first recipe with recipe_nam == $recipe_name

       return view('recipes/single',array( //Pass the recipe to the view
           'recipe' => $recipe
       ));
    }

· Modifiez votre application pour faire fonctionner l’affichage d’une recette.
· La recette affiche le nom du propriétaire


Exercice 7 - Formulaire de contact
· Créez une route dans votre fichier de routes (routes/web.php) pour afficher le formulaire de contact et traiter les données soumises.
 Utiliser la commande php artisan make:controller ContactController pour générer le contrôleur. 
Dans la méthode showForm du contrôleur ContactController, retournez simplement la vue contenant le formulaire de contact. 
 Dans la méthode submitForm du contrôleur ContactController, utilisez la classe Illuminate\Http\Request pour valider les données soumises par le formulaire. Vous pouvez utiliser la méthode validate pour appliquer les règles de validation appropriées. Par exemple :

Exercice 8 - Le CRUD d’une recette
1. Si vous voulez accéder au Crud des recettes, vous devez entrer ce login : Localhost:8000/recipes
2. Si vous souhaitez en savoir plus sur la recette, cliquez sur le bouton "Read more".
Si vous souhaitez mettre à jour la recette, cliquez sur le bouton "Edit".
Si vous souhaitez supprimer une recette, cliquez sur le bouton "Delete".


Le formulaire de commentaires :
- Créez une vue "lame" pour la page de la recette où les utilisateurs peuvent soumettre des commentaires.
- Concevez un formulaire avec des champs pour le nom, l'e-mail, le texte du commentaire et le CAPTCHA (le cas échéant).
- Utilisez le moteur de template Blade de Laravel pour créer le formulaire.
Gérer la soumission du formulaire :
- Définir une route pour gérer la soumission du formulaire.
- Créer une méthode de contrôleur pour traiter les données du formulaire.
- Valider les données saisies à l'aide du système de validation de Laravel.
- Sauvegarder les données des commentaires validés dans la base de données en utilisant Eloquent ORM.
- Mettre en place une notification par email pour informer les administrateurs des nouveaux commentaires.
Afficher les commentaires :
- Récupérer les commentaires de la base de données en utilisant Eloquent.
- Transmettre les données des commentaires à la page d'affichage de la recette.
- Itérer sur les données des commentaires dans la vue pour les afficher sous le formulaire de commentaire.
Intégration CAPTCHA :
- Intégrez un service CAPTCHA (par exemple, Google reCAPTCHA) dans votre formulaire de commentaire.

Fonctionnalités supplémentaires
Difficultés rencontrées
1.Le problème des bogues
2.Conflit sur le choix des fonctionnalités supplémentaires à privilégier
3.Gestion des conflits de fusion
4.Impossibilité d'enregistrer des informations dans la base de données

Credits:
Melody Magodo
Akua Serwaa Dankwah
https://www.freecodecamp.org/


 ## Existing code
 [![Review Assignment Due Date](https://classroom.github.com/assets/deadline-readme-button-24ddc0f5d75046c5622901739e7c5dd533143b0c8e959d652212380cedb1ea36.svg)](https://classroom.github.com/a/XkFLMmQ7)
[![Open in Codespaces](https://classroom.github.com/assets/launch-codespace-7f7980b617ed060a017424585567c406b6ee15c891e84e1186181d67ecf80aa0.svg)](https://classroom.github.com/open-in-codespaces?assignment_repo_id=14189320)
<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

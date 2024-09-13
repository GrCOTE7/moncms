---
markmap:
  duration: 2000
  initialExpandLevel: -1
---
# Mon CMS <!-- markmap: duration: 1000 -->
<-- Réf.: <https://laravel.sillo.org/posts/mon-cms-les-donnees> -->
<-- VSCode: Utiliser extention markmap -->

## Base

### 1 / Base Laravel <!-- markmap: fold -->

- *composer  create-project laravel/laravel moncms --prefer-dist*
- Paramètres .env file (APP_NAME, APP_URL & DB_DATABASE)
- Ajout Fr : *composer require --dev laravel-lang/common
  php artisan lang:update*

### 2 / Gestion des Models et Tables <!-- markmap: fold -->
  
- Tables: <!-- markmap: fold -->
  - Migration seule : *php artisan make:migration create_nnn_table*
  - Factory : *php artisan make:factory MmmFactory*
  - Seeders : *php artisan make:seeder MmmSeeder*
  - Penser à appeler les seeders dans database/seeders/DataBaseSeeder.php:
    *$this->call([
      Mmm1Seeder::class,
      Mmm2Seeder::class,
      etc...]);*
  - Puis les exécuter : *php artisan db:seed*
- Models + migration : <!-- markmap: fold -->
  - Migrations
    - *php artisan make:model Mmm --migration* ou
      *php artisan make:model Mmm -m*
    - *php artisan migrate* la 1ère fois
    - *php artisan migrate:refresh --seed* ensuite
  - Model (Mmm) :
    - *protected $timestamps = false;*
    - *protected $fillable = ['name', 'email', 'password', 'role', 'valid'];*
  - Relations :
    - 1:n :
      - (1) : Dans MmmN
        - *use Illuminate\Database\Eloquent\Relations\BelongsTo;*
        - *public function Mmm1(): BelongsTo {
        return $this->belongsTo(Mmm1::class);}*
      - (n) : Dans Mmm1
        - *use Illuminate\Database\Eloquent\Relations\HasMany;*
        - *public function MmmN(): HasMany {
        return $this->HasMany(MmmN::class);}*

### 3 / Divers <!-- markmap: fold -->

- helpers:

  - app/helpers.php (Y écrire les fonctions appelées souvent un peu n'importe où)
  - Dans composer.json :
    *"autoload": {
    "files": [
    "app/helpers.php"
    ],...},*
- composer dumpautoload

### Réf.: **<https://laravel.sillo.org/posts/mon-cms-les-donnees>**

## Technos FrontEnd

### MaryUI <!-- markmap: fold -->

- *composer require robsontenorio/mary*
- *php artisan mary:install*
  - Doc MaryUI <https://mary-ui.com>

php artisan mary:install
→ 0 (livewire/Volt)
→ npm install --save-dev (npm)

### Volt <!-- markmap: fold -->

- Une vue Volt (Dans /route/web.php) :
*Volt::route('/*url*', 'dossier(s).fichier')->name('dossier.fichier');*
- Un nouveau composant Volt :
*php artisan make:volt dossier/fichier* --class
  - Class PHP
  - Template Blade
- À utiliser pour faire register / login / forgot-password
(En pensant aussi à faire les routes correspondantes)

### Référence: **<https://laravel.sillo.org/posts/mon-cms-lauthentification>**

## FrontEnd

### index (HomePage) <!-- markmap: fold -->

#### Image

- *php artisan storage:link*
  (Lien symbolique de public/storage vers storage/app/public)

#### Référence: **<https://laravel.sillo.org/posts/mon-cms-la-page-daccueil>**

### Les articles <!-- markmap: fold -->

#### posts/show

#### Dynamic Title/Description/Keywords (S.E.O.) <!-- markmap: fold -->

- **Layout:**
title :
*\<title>{{ (isset($title) ? $title . ' | ' :
(View::hasSection('title') ? View::getSection('title') . ' | ' :
 '')) . config('app.name') }}</title>
\<meta name="description" content="@yield('description')">
\<meta name="keywords" content="@yield('keywords')">*
- **Vue** (Blade):
@php
&nbsp;&nbsp;$title='TitrePage'
@endphp
ou :
@section('title', $post->seo_title ?? $post->title)
Et :
@section('description', $post->meta_description)
@section('keywords', $post->meta_keywords

#### Plugin prose de Tailwind <!-- markmap: fold -->

- *npm install -D @tailwindcss/typography*
- exports default {
&nbsp;&nbsp;...
&nbsp;&nbsp;plugins: [
&nbsp;&nbsp;&nbsp;&nbsp;plugins: [require("@tailwindcss/typography"), require("daisyui")],
&nbsp;&nbsp;],
}
- *\<div class="relative items-center w-full py-5 mx-auto prose md:px-12 max-w-7xl">*

#### Librairie prismjs <!-- markmap: fold -->

- Configure prism.css et prism.js : <https://prismjs.com/download.html>
- Poser dans layout:
...
\<head>
...
&nbsp;&nbsp;***\<link rel="stylesheet" href="{{ asset('storage/css/prism.css') }}">***
\</head>
\<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">
...
&nbsp;&nbsp;***\<script src="{{ asset('storage/scripts/prism.js') }}"></script>***
\</body>

#### Mode clair/sombre <!-- markmap: fold -->

- tailwind.config.js :
*export default {
...
&nbsp;&nbsp;darkMode: 'class',
}*

- navigation/navbar.blade.php :
&nbsp;&nbsp;&nbsp;&nbsp;\<x-theme-toggle title="{{ __('Toggle theme') }}" class="w-4 h-8" />
&nbsp;&nbsp;</x-slot:actions>
\</x-nav>

- Doc MaryUI <https://mary-ui.com/docs/components/theme-toggle>

#### Search bar <!-- markmap: fold -->

##### Composant search <!-- markmap: fold -->

    (PHP (La logique)

  ```bash
    use Livewire\Attributes\Validate;
    use Livewire\Volt\Component;
    
    new class() extends Component {
    
        #[Validate('required|string|max:100')]
        public string $search = '';
    
        public function save() {
        $data = $this->validate();
    
        return redirect('/search/' . $data['search']);
        }
    };
  ```
  
    HTML (Blade) pour La Vue)

  ```bash
    <div>
      <form wire:submit.prevent="save">
      <x-input placeholder="{{ __('Search') }}..." wire:model="search" clearable icon="o-magnifying-glass" />
      </form>
    </div>
  ```

##### Traduction nécessaire (**fr.json**) <!-- markmap: fold -->

- **"Search...": "Rechercher...",**

##### La route (route/web.php) <!-- markmap: fold -->

```bash
*Volt::route('/search/{param}', 'index')->name('posts.search');*
```

Particularité: Renvoie aussi sur la vue index

##### Ajouter dans app/Repositories/PostRepository.php <!-- markmap: fold -->

    La fonction qui inclue la chaîne du formulaire pour gérer la recherche :

  ```php
  public function search(string $search): LengthAwarePaginator {
      return $this->getBaseQuery()
        ->latest()
        ->where(function ($query) use ($search) {
        $query->where('title', 'like', "%{$search}%")
          ->orWhere('body', 'like', "%{$search}%");
        })
        ->paginate(config('app.pagination'));
    }
  ```

##### Composant index (Homepage (Page d'accueil)) <!-- markmap: fold -->

###### **Bloc PHP** : Quand on récupère les posts

    (function getPosts()), on déclenche le composant search
    si l'URI comporte un paramètre) :

```php
if (!empty($this->param)) {
    return $postRepository->search($this->param);
}
```

###### **Bloc Vue Blade** : S'il y a une recherche

    Alors, on affiche le titre de la page adapté :

```php
    @if ($category)
        <x-header title="{{ __('Posts for category ') }} {{ $category->title }}" size="text-2xl sm:text-3xl md:text-4xl" />
    @elseif($param !== '')
        <x-header title="{{ __('Posts for search ') }} '{{ $param }}'" size="text-2xl sm:text-3xl md:text-4xl" />
    @endif
```

    Traduction: 

```php
    "Posts for search ": "Articles pour la recherche ",
```

##### Vue HTML - navigation/navbar.php <!-- markmap: fold -->

```php
      <x-theme-toggle title="{{ __('Toggle theme') }}" class="w-4 h-8" />
      <livewire:search />
  </x-slot:actions>
</x-nav>
```

#### Référence: **<https://laravel.sillo.org/posts/mon-cms-les-articles>**

### Les menus (Gérés par backoffice)

#### Les données

#### Composant frontend

#### Barre de Navigation

#### Menu Pied de page




#### Dynamic Title/Description/Keywords (S.E.O.) <!-- markmap: fold -->

- **Layout:**
title :
*\<title>{{ (isset($title) ? $title . ' | ' :
(View::hasSection('title') ? View::getSection('title') . ' | ' :
 '')) . config('app.name') }}</title>
\<meta name="description" content="@yield('description')">
\<meta name="keywords" content="@yield('keywords')">*
- **Vue** (Blade):
@php
&nbsp;&nbsp;$title='TitrePage'
@endphp
ou :
@section('title', $post->seo_title ?? $post->title)
Et :
@section('description', $post->meta_description)
@section('keywords', $post->meta_keywords

#### Plugin prose de Tailwind <!-- markmap: fold -->

- *npm install -D @tailwindcss/typography*
- exports default {
&nbsp;&nbsp;...
&nbsp;&nbsp;plugins: [
&nbsp;&nbsp;&nbsp;&nbsp;plugins: [require("@tailwindcss/typography"), require("daisyui")],
&nbsp;&nbsp;],
}
- *\<div class="relative items-center w-full py-5 mx-auto prose md:px-12 max-w-7xl">*

#### Librairie prismjs <!-- markmap: fold -->

- Configure prism.css et prism.js : <https://prismjs.com/download.html>
- Poser dans layout:
...
\<head>
...
&nbsp;&nbsp;***\<link rel="stylesheet" href="{{ asset('storage/css/prism.css') }}">***
\</head>
\<body class="min-h-screen font-sans antialiased bg-base-200/50 dark:bg-base-200">
...
&nbsp;&nbsp;***\<script src="{{ asset('storage/scripts/prism.js') }}"></script>***
\</body>

#### Mode clair/sombre <!-- markmap: fold -->

- tailwind.config.js :
*export default {
...
&nbsp;&nbsp;darkMode: 'class',
}*

- navigation/navbar.blade.php :
&nbsp;&nbsp;&nbsp;&nbsp;\<x-theme-toggle title="{{ __('Toggle theme') }}" class="w-4 h-8" />
&nbsp;&nbsp;</x-slot:actions>
\</x-nav>

- Doc MaryUI <https://mary-ui.com/docs/components/theme-toggle>

#### Search bar <!-- markmap: fold -->

##### Composant search <!-- markmap: fold -->

    (PHP (La logique)

  ```bash
    use Livewire\Attributes\Validate;
    use Livewire\Volt\Component;
    
    new class() extends Component {
    
        #[Validate('required|string|max:100')]
        public string $search = '';
    
        public function save() {
        $data = $this->validate();
    
        return redirect('/search/' . $data['search']);
        }
    };
  ```
  
    HTML (Blade) pour La Vue)

  ```bash
    <div>
      <form wire:submit.prevent="save">
      <x-input placeholder="{{ __('Search') }}..." wire:model="search" clearable icon="o-magnifying-glass" />
      </form>
    </div>
  ```

##### Traduction nécessaire (**fr.json**) <!-- markmap: fold -->

- **"Search...": "Rechercher...",**

##### La route (route/web.php) <!-- markmap: fold -->

```bash
*Volt::route('/search/{param}', 'index')->name('posts.search');*
```

Particularité: Renvoie aussi sur la vue index

##### Ajouter dans app/Repositories/PostRepository.php <!-- markmap: fold -->

    La fonction qui inclue la chaîne du formulaire pour gérer la recherche :

  ```php
  public function search(string $search): LengthAwarePaginator {
      return $this->getBaseQuery()
        ->latest()
        ->where(function ($query) use ($search) {
        $query->where('title', 'like', "%{$search}%")
          ->orWhere('body', 'like', "%{$search}%");
        })
        ->paginate(config('app.pagination'));
    }
  ```

##### Composant index (Homepage (Page d'accueil)) <!-- markmap: fold -->

###### **Bloc PHP** : Quand on récupère les posts

    (function getPosts()), on déclenche le composant search
    si l'URI comporte un paramètre) :

```php
if (!empty($this->param)) {
    return $postRepository->search($this->param);
}
```

###### **Bloc Vue Blade** : S'il y a une recherche

    Alors, on affiche le titre de la page adapté :

```php
    @if ($category)
        <x-header title="{{ __('Posts for category ') }} {{ $category->title }}" size="text-2xl sm:text-3xl md:text-4xl" />
    @elseif($param !== '')
        <x-header title="{{ __('Posts for search ') }} '{{ $param }}'" size="text-2xl sm:text-3xl md:text-4xl" />
    @endif
```

    Traduction: 

```php
    "Posts for search ": "Articles pour la recherche ",
```

##### Vue HTML - navigation/navbar.php <!-- markmap: fold -->

```php
      <x-theme-toggle title="{{ __('Toggle theme') }}" class="w-4 h-8" />
      <livewire:search />
  </x-slot:actions>
</x-nav>
```

#### Référence: **<https://laravel.sillo.org/posts/mon-cms-les-menus>**

# TMBox

 TMBox is using [The Movie Database (TMDb)](https://developers.themoviedb.org/3/getting-started/introduction) API to get the info about movies, tv shows and actors.
 

Stack used:
- Laravel & Livewire,
- Alpine.js,
- Tailwind Css,


## Setup

1. Install Composer Dependencies:
```
composer install
```
2. Install NPM Dependencies:
```
npm install
```
3. Create a new .env file (copy of env.example):
```
cp .env.example .env
```
4. Generate an app encryption key:
```
php artisan key:generate
```
5. In the .env file, add your TMDB_TOKEN. 

6. To compile assets (Mix) run :
```
npm run dev
```
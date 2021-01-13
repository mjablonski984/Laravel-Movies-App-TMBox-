<?php

use Illuminate\Support\Facades\Route;

// Livewire routes -> each component has its own controller insted of standard Laravel routes (array of controller ClassName and its method)
Route::get('/',\App\Http\Livewire\Pages\Movies\Index::class)->name('movies.index');
Route::get('/movies/{movieId}',\App\Http\Livewire\Pages\Movies\Show::class)->name('movies.show');
Route::get('/movies/discover/{keywordId}/{keywordName}/{page?}',\App\Http\Livewire\Pages\Movies\Discover\Index::class)->name('movies.discover.index');

Route::get('/tv',\App\Http\Livewire\Pages\Tv\Index::class)->name('tv.index');
Route::get('/tv/{tvId}',\App\Http\Livewire\Pages\Tv\Show::class)->name('tv.show');
Route::get('/tv/discover/{keywordId}/{keywordName}/{page?}',\App\Http\Livewire\Pages\Tv\Discover\Index::class)->name('tv.discover.index');

Route::get('/actors',\App\Http\Livewire\Pages\Actors\Index::class)->name('actors.index');
Route::get('/actors/page/{page?}',\App\Http\Livewire\Pages\Actors\Index::class);
Route::get('/actors/{actor}',\App\Http\Livewire\Pages\Actors\Show::class)->name('actors.show');

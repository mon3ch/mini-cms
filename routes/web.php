<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'etudiant' => 'Moneam',
        'groupe' => 'Groupe 1',
        'cours' => 'Laravel',
    ]);
});
Route::get('/bonjour', function () {
    return 'Bonjour MDW3 ! Voici ma première route Laravel 13.';
});

Route::get('/bonjour-court', fn () => 'Même résultat, écrit avec une fonction fléchée.');

Route::get('/bienvenue', function () {
    return view('bienvenue', [
        'etudiant' => 'Prenom Nom',
        'groupe' => 'MDW32',
        'cours' => 'Atelier Framework Côté Serveur',
    ]);
});
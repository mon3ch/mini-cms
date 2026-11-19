# Session 08 - Défi

La route posts.tag utilise {tag:slug} : oui

La page d'un tag n'affiche ni brouillon ni article d'un autre tag : oui

Les tags des cartes sont des liens : oui

L'accueil n'affiche que les tags qui ont au moins un article publié : oui

Les tests passent et php artisan test est vert : oui

Pourquoi filtrer les tags vides après get() plutôt que d'afficher (0) ?

Combien de requêtes ajoute la liste des tags populaires, et pourquoi pas une par tag ?

Elle ajoute une requête avec une sous-requête de comptage ; la base compte les articles de tous les tags à la fois, sans charger leurs articles.

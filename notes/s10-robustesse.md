# Session 10 - Robustesse

- [x] TagAdminTest contient 5 tests verts.
- [x] `/posts/categorie/inconnue` affiche Catégorie introuvable avec le statut 404.
- [x] `php artisan test` est vert.

1. Pourquoi le message de `messages()` l'emporte-t-il sur celui de `lang/fr/validation.php` ?

Laravel utilise d'abord le message le plus précis associé à la règle et au champ dans la Form Request.

2. Pourquoi `phpunit.xml` fixe-t-il `APP_LOCALE` ?

Pour que les tests français donnent le même résultat sur tous les postes et les clones propres.

3. Pourquoi `CategoryController` n'a-t-il besoin d'aucun `try/catch` ?

La Form Request, la liaison de modèle, le middleware et le gestionnaire d'exceptions prennent déjà en charge les erreurs prévues.

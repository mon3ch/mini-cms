# Cycle de vie d'une requete vers /heure

Le navigateur envoie une requete GET vers `/heure`. `public/index.php` est le seul point d'entree : il charge l'autoloader Composer, puis charge `bootstrap/app.php`. Cette configuration cree l'application et charge `routes/web.php`.

Le routeur trouve la route `/heure` dans `routes/web.php` et execute sa closure. La closure utilise `now()` pour fournir l'heure et la date, puis renvoie `resources/views/heure.blade.php`. Blade est compile en HTML et Laravel renvoie la reponse au navigateur.

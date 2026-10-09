# Session 02 - Git et GitHub

Réponses rédigées avec mes propres mots, puis comparées au corrigé de la page.

## 1. Index et commit

Réponse :git add` fait passer un fichier du répertoire de travail à l'index (les changements sont préparés). `git commit` fait passer ce qui est dans l'index vers le dépôt local, où il est enregistré dans l'historique. Donc `git add` seul n'enregistre rien dans l'historique.


## 2. Branche et tag

Réponse :Une branche (par exemple `main`) est une étiquette mobile : à chaque nouveau commit, elle avance pour désigner ce commit. Un tag (par exemple `lab-01`) reste fixé sur un seul commit, pour toujours. On termine chaque session par un tag pour garder l'état exact du projet à la fin de la session.


## 3. Le fichier .env

Réponse :Le fichier `.env` contient `APP_KEY` et des réglages propres au poste, et en production il contient des secrets, donc il ne doit jamais être poussé sur GitHub. Un autre développeur obtient le sien en copiant `.env.example` vers `.env`, puis en lançant `php artisan key:generate`.


## 4. Le dossier vendor/

Réponse :`vendor/` contient les dépendances PHP, soit des milliers de fichiers générés, donc il n'est pas versionné. On peut le reconstruire avec `composer install`, qui installe les versions exactes grâce au fichier `composer.lock`.


## 5. Git Credential Manager

Réponse :Git Credential Manager range le jeton GitHub dans le Gestionnaire d'identification Windows (entrée `git:https://github.com`). Sur un poste de l'université, il faut le supprimer en fin de séance (et se déconnecter de github.com dans le navigateur), parce que toute personne qui utilise la même session Windows pourrait pousser en mon nom. Sur mon ordinateur personnel, je le garde.
Lancer le site en local :

01-Téléchargez et installez Docker ainsi que VS Code.
02-Récupérez le projet depuis mon GitHub à l'adresse : https://github.com/yrautcnasdemo/Quoi-de-Neuf-Doc.
03-Dans l'onglet Code, allez dans HTTPS et copiez le lien du projet pour le cloner.
04-Lien direct pour cloner le projet : https://github.com/yrautcnasdemo/Quoi-de-Neuf-Doc.git.
05-Dans VS Code, cliquez sur File puis New Window, sélectionnez Clone Git Repository, et collez le lien du projet dans la barre en haut de l'écran.
06-Sélectionnez un dossier où enregistrer le projet.
07-Assurez-vous que Docker est bien lancé, puis ouvrez le terminal de VS Code via Terminal → New Terminal.
08-Dans le terminal, tapez : docker-compose build (pour construire les services définis dans le fichier docker-compose.yml).
09-Attendez quelques secondes pour que le build se termine, puis tapez : docker-compose up pour lancer le système.

10-Une fois ces étapes terminées, ouvrez Docker. Vous y verrez votre projet lancé. 

Il ne reste plus qu'à cliquer sur les adresses IP affichées pour accéder au projet et à la base de données.
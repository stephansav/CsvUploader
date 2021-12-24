# CsvUploader
A Csv Uploader which handle errors

# Afin d'installer le projet
composer install

# Tester sur POSTMAN
Vous pouvez tester l'API sur POSTMAN

Choisissez le verbe POST et ajouter l'URL https://127.0.0.1:8000/csv/upload

Cliquez sur body

1) Dans la colonne *key* ajouter le mot clé *file* puis choisissez file dans le menu déroulant au niveau du champs key.

2) Puis, choisissez le fichier que vous souhaitez uploader dans le champs *value*

# Lancer les tests
Vous pouvez lancer les tests qu'une fois. Une fois les fichiers uploader ils ne seront présents dans le dossier d'expédition.

php bin/phpunit tests/DumbTest.php




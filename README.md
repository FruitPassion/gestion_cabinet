# Gestion Cabinet

## Configuration Docker

Le chemin `/path/to/gestion_cabinet/` doit être remplacé par le chemin absolu du dossier `gestion_cabinet` du projet.

```dockerfile
sudo docker run --restart unless-stopped --name gestionCabinet -p 41061:22 -p 41062:80 -d -v /path/to/gestion_cabinet/:/opt/lampp/htdocs/ tomsik68/xampp:8 
```

On peux ensuite accéder au site via l'adresse `http://localhost:41062/`

## Configuration de la base de données

Le fichier de création de la base de données se nomme `sql/gestion_cabinet.sql` et se trouve à la racine du projet.

Il est nécessaire de créer la base de donnée à l'aide de ce fichier dans le container.
La connexion via un gestionnaire de base de données est possible en établissant un tunnel SSH sur le port 41061.
<br>
Le nom d'utilisateur est `root` et le mot de passe est `root` pour la connexion SSH.
<br>
Pour la base de données le nom d'utilisateur est `root` et le mot de passe est vide, le port est `3306`.

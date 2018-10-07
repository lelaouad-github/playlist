### Utilisation

#### 1. installation de la base de données.
Vous trouverez le dump sql dans le dossier assets. Il faut l'importer avant d'utiliser le projet.

#### 2. Configuration de la connexion à la base de données
Les paramètres de configuration de la base de données sont dans le fichier **config/db.php**. Editez le afin que l'API puisse accéder à la base de données.

#### 3. Démarrage de l'API
Executez, à la racine du projet, le commande pour importer les dépendances :
```
composer install
```
Pour démarrer l'API, executez le server PHP à l'aide de la commande suivante :
```
php -S localhost:8000 -t public
```

#### 4. les ressources
##### Playlist
Method | URI | description
---|---|---
GET | /playlist | retourne la liste des playlistes.
GET | /playlist/{uuid} | retourne une playliste.  
POST | /playlist | crée une playliste.
PUT | /playlist/{uuid} | modifie une playliste. 
DELETE | /playlist/{uuid} | supprime une playliste.  
##### Video
Method | URI | description
---|---|---
GET | /video | retourne toutes les vidéos.
GET | /playlist/{playlist_uuid}/video | retourne les vidéos d'un playliste. 
GET | /video/{uuid} | retourne une vidéo. 
POST | /playlist/{playlist_uuid}/video | crée une video pour une playlist.
PUT | /video/{uuid} | modifie une vidéo. 
DELETE | /video/{uuid} | supprime une vidéo.  

#### 5. Le modèle de données
##### Playlist
Colonne | type | description
---|---|---
uuid | string / varchar | primary key
name | string / varchar | 
created_at | datetime | 
published_at | datetime |

##### Video
Colonne | type | description
---|---|---
uuid | string | primary key
title | string / varchar | 
created_at | DateTime / datetime | 
published_at | DateTime / datetime | 
duration | DateInterval / string | Format : PT[xx]H[xx]M[xx]S
view_count | integer | 
thumbnail | string / varchar |
rank | interger


# README

Ce document fournit des instructions pour tester le projet en récupérant une image Docker et en utilisant un Docker Compose.

## Prérequis 

### LINUX

- Avoir Docker installé sur votre machine. Pour l'installation, suivez les instructions sur [Docker](https://docs.docker.com/get-docker/).
- Avoir Docker Compose installé. Pour l'installation, consultez [Docker Compose](https://docs.docker.com/compose/install/).
- Accès à Docker Hub 

### WINDOWS

- Docker installé sur votre machine Windows.
- Accès à Docker Hub
- **- UN TERMINAL GITBASH pour executez toutes les commandes**

## GUIDE INSTALLATION & LANCEMENT PROJET

### 1: Récupérer le Repository GitHub

Clonez le repository GitHub contenant les fichiers nécessaires dans un dossier vide :

```bash
git clone https://github.com/fyleeds/ecommerce

```

### 2: Lancez Docker

#### SUR WINDOWS : 

Double-Clickez sur l'icone de Docker Desktop et attendez son chargement

#### SUR LINUX : 

```bash
sudo systemctl start docker
```

### 3: Connexion à Docker Hub

Avant de tirer des images depuis Docker Hub, assurez-vous de vous connecter à votre compte Docker Hub :
```bash
docker login
```
Entrez votre nom d'utilisateur et votre mot de passe lorsque vous y êtes invité.

### 4: Récupérer l'Image Docker

récupérez l'image nécessaire avec la commande suivante :
```bash
docker pull fyleeds/ecommerce:v2
```
Cette commande va télécharger la version 2 de l'image `fyleeds/ecommerce` de Docker Hub.

### 5: Lancez les conteneurs depuis un terminal

Restez sur le terminal et naviguez vers le dossier "docker" dans le projet : 
```bash
cd chemin/vers/dossier_de_clone/ecommerce/docker
```
Puis déployez le site avec la commande : 
```bash
docker compose up 
```

*REMARQUE : SI CELA NE MARCHE PAS FAITES LES COMMANDES SUIVANTES 
IL SE PEUT QUE LA BASE DE DONNEE N'EST PAS CHARGE COMPLETEMENT : *
```bash
docker compose down 
```
```bash
docker compose up
```

### 6: Accès services depuis votre navigateur

Après avoir exécuté la commande, Docker Compose va démarrer les services.

- Accédez à http://localhost:80 pour voir l'application ecommerce.
- Accédez à http://localhost:8080 pour phpMyAdmin.

### 7 Quittez le projet

Dans le dossier docker executez : 
```bash
docker compose down 
```

### Conclusion

Vous avez maintenant déployé avec succès l'application ecommerce avec une base de données MySQL et phpMyAdmin pour la gestion de la base de données. Pour toute modification ou mise à jour, assurez-vous de redémarrer les services pour appliquer les changements.


# README

# Tutoriel Docker pour l'équipe

Ce document fournit des instructions pour tester et éditer le projet en récupérant une image Docker et en utilisant un Docker Compose.

## Prérequis 

### LINUX

- Avoir Docker installé sur votre machine. Pour l'installation, suivez les instructions sur [Docker](https://docs.docker.com/get-docker/).
- Avoir Docker Compose installé. Pour l'installation, consultez [Docker Compose](https://docs.docker.com/compose/install/).
- Accès à Docker Hub 

### WINDOWS

- Docker installé sur votre machine Windows.
- Un éditeur de texte comme Notepad, Notepad++, Visual Studio Code, etc.
- Accès à Docker Hub 

## GUIDE

### Étape 1: Récupérer le Repository GitHub

Clonez le repository GitHub contenant les fichiers nécessaires pour votre projet :

```bash
git clone https://github.com/fyleeds/ecommerce
cd ecommerce
```

### WINDOWS : 

## Étapes

### 1: Ouvrir l'Explorateur de Fichiers

Ouvrez l'Explorateur de Fichiers et naviguez jusqu'à votre répertoire de travail.

### 2: Récupérer l'Image Docker

Avant de lancer votre environnement Docker, assurez-vous de récupérer l'image nécessaire. Ouvrez le terminal ou l'invite de commande et exécutez la commande suivante :

```bash
docker pull fyleeds/ecommerce:latest
```

Cette commande va télécharger la dernière version de l'image `fyleeds/ecommerce` de Docker Hub.

### 3: Lancez les conteneurs depuis un terminal

Restez sur le terminal et naviguez vers le dossier "docker" dans le projet : 

```bash
cd chemin/vers/Projet/docker
```

Puis déployez avec la commande : 
```bash
docker compose up 
```

### 4: Accès services depuis votre navigateur

Après avoir exécuté la commande, Docker Compose va démarrer les services.

- Accédez à http://localhost pour voir l'application ecommerce.
- Accédez à http://localhost:8080 pour phpMyAdmin.

### LINUX : 

#### 1: Naviguer vers un répertoire vide de votre choix

Naviguez vers le répertoire de travail par exemple "Projet" : 

```bash
cd chemin/vers/Projet
```

#### 2: Récupérer l'Image Docker

Avant de lancer votre environnement Docker, assurez-vous de récupérer l'image nécessaire. Ouvrez le terminal ou l'invite de commande et exécutez la commande suivante :

```bash
docker pull fyleeds/ecommerce:latest
```

Cette commande va télécharger la dernière version de l'image `fyleeds/ecommerce` de Docker Hub.

#### 3: Lancez les conteneurs

```bash
docker compose up 
```

#### 4: Accès services depuis votre navigateur

Après avoir exécuté la commande, Docker Compose va démarrer les services.

- Accédez à http://localhost pour voir l'application ecommerce.
- Accédez à http://localhost:8080 pour phpMyAdmin.

### Conclusion

Vous avez maintenant déployé avec succès l'application ecommerce avec une base de données MySQL et phpMyAdmin pour la gestion de la base de données. Pour toute modification ou mise à jour, assurez-vous de redémarrer les services pour appliquer les changements.

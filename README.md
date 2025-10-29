# ToDoList Symfony Project

![Symfony](https://img.shields.io/badge/Symfony-6.x-black?logo=symfony\&logoColor=white)
![PHP](https://img.shields.io/badge/PHP-8.x-blue?logo=php\&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-8.x-orange?logo=mysql\&logoColor=white)
![MIT License](https://img.shields.io/badge/License-MIT-green)

## Description

Application Symfony pour gérer une liste de tâches (ToDoList).
Permet de créer, modifier et supprimer des tâches avec priorité et état d'avancement.

---

## Prérequis

* PHP >= 8.x
* Composer
* Symfony CLI
* MySQL ou MariaDB

---

## Installation

### Cloner le projet

```bash
git clone https://github.com/OpheliePDev/mini_site.git
cd mini-site
```

### Installer les dépendances

```bash
composer install
```

### Configurer la base de données

Renommer `.env.example` en `.env` et modifier la variable `DATABASE_URL` avec vos informations MySQL.

### Créer la base et exécuter les migrations

```bash
symfony console doctrine:database:create
symfony console make:migration
symfony console doctrine:migrations:migrate
```

---

## Commandes utiles

* **Créer une migration**

```bash
symfony console make:migration
```

* **Exécuter les migrations**

```bash
symfony console doctrine:migrations:migrate
```

* **Vérifier la cohérence entité/base**

```bash
symfony console doctrine:schema:validate
```

* **Lancer le serveur Symfony**

```bash
symfony server:start
```

* **Stopper le serveur Symfony**

```bash
symfony server:stop
```

## Structure du projet

Voici un diagramme textuel pour visualiser l’architecture :

```
src/
├─ Entity/        # Classes qui représentent les tables en base de données
├─ Repository/    # Accès et filtrage des données
├─ Controller/    # Gestion des requêtes HTTP et logique applicative
migrations/       # Fichiers de migration pour mettre à jour la base
templates/        # Fichiers HTML dynamiques (Twig)
public/           # Fichiers accessibles depuis le navigateur

```

## Schéma de fonctionnement

```
[Base de données] <---> [Entity] <---> [Repository]
  |
  v
[Controller] ---> [Templates Twig] ---> [Utilisateur]
```

💡 **Explications supplémentaires**

* **Entity** : "tables vivantes" en PHP
* **Repository** : interroge la base pour récupérer les données
* **Controller** : décide quoi afficher et quelle logique exécuter
* **Migrations** : versionnent la base et suivent les entités
* **Templates** : affichage HTML dynamique
* **Public** : point d’entrée visible par le navigateur

---

## Branches

* `main` : branche stable, contient le projet fonctionnel
* `todolist` : branche de développement de la fonctionnalité TodoList
* `tasklist` : branche de développement de la fonctionnalité Liste de tâches

  * Ajout de la gestion des priorités
  * Code expérimental à fusionner dans `main` après validation

---

## Contribution

1. Créez une branche à partir de `main` :

```bash
git checkout -b ma-fonctionnalité
```

2. Faites vos modifications et commit :

```bash
git add .
git commit -m "Ajout d'une nouvelle fonctionnalité"
```

3. Poussez sur le dépôt et créez une Pull Request :

```bash
git push origin ma-fonctionnalité
```

---

## Notes

* Toujours valider les migrations avant de les exécuter
* Les champs `nullable` dans les entités doivent correspondre à la base
* Workflow Git : Une fois qu'une fonctionnalité est terminée et validée, la branche de fonctionnalité est fusionnée avec la branche `main`. Toutes les branches de travail sont visibles dans le dépôt.

---

## Licence

Ce projet est sous licence [MIT](./LICENSE).
# Collection – Projet PHP / MySQL

Projet web réalisé en **PHP** et **MySQL**, visant à créer une **Collection** avec gestion des personnages, éléments, origines, classes et collections par utilisateur.
Dans ce cas précis il s'agit d'une collection basée sur l'univers Mario, mais cela reste déclinable.

---

## 🎯 Objectifs
- Application web en PHP
- Base de données relationnelle MySQL
- Architecture MVC simplifiée
- Authentification utilisateur
- Collection de personnages par utilisateur

---

## ⚙️ Languages
- PHP
- MySQL (phpMyAdmin)
- HTML / CSS
- WAMP / XAMPP / MAMP
- Git / GitHub
- Images `.webp`

---

## 🗂️ Structure du projet
```
Projet/
├── Config/
├── Controllers/
├── Helpers/
├── logs/
├── Models/
├── Services/
├── Views/
├── public/img/
├── vendor/
├── index.php
└── .gitignore
```

---

## 📦 Fonctionnalités
- Affichage des personnages
- Relations :
  - personnage ↔ origine
  - personnage ↔ classe
  - personnage ↔ éléments (N-N)
- Authentification utilisateur
- Collection utilisateur
- Pages protégées

---

## 🖼️ Images
Dossier :
```
public/img/
```
Exemples :
- `public/img/Mario.webp`
- `public/img/ElementFleurDeFeu.webp`

---

## 🚀 Installation

0. Télécharger le projet
1. Installer le dossier Vendor et coller le à la racine du projet 
2. Installer WAMP 
3. Lancer PHPmyadmin, créer le dossier dev.ini dans le dossier Config ou modifier le dossier dev_sample.ini
4. Compléter par le nom de votre base de donnée et vos identifiants phpMyAdmin
5. Copier le projet dans `www/` 
6. Importer la base de données (script ci-dessous)
7. Accéder à :

Pour commencer, vous devez créer un compte : 
  - Register : Pseudo / mdp / mdp.
  - Ensuite il suffit de se connecter avec vos identifiants. La première chose à faire est d'ajouter au moins une classe, une origine et un élement pour ensuite
    pouvoir ajouter votre premier personnage. Ceci étant vous pouvez avoir accès à la collection globale de l'application dans le menu Home. Cliquez sur une des
    cartes de n'importe quel personnage pour voir ses données (Id, classe, élements...). A partir de ce menu vous pouvez modifier, supprimer ou encore ajouter puis
    retirer le personnage à votre collection personnelle.
  - Par exemple, vous pouvez commencer par ajouter les classes Plombier, Princesse ou Koopa puis les élements Champignon, Super Etoile ou Fleur de feu et enfin
    l'origine Royaume Champignon.
    
```
http://localhost/Projet/
```

Connexion PDO (exemple) :
```php
$pdo = new PDO(
  "mysql:host=localhost;dbname=projet;charset=utf8mb4",
  "root",
  ""
);
```

---

## 🗄️ Base de données (SCRIPT SQL COMPLET)

```sql
DROP DATABASE IF EXISTS projet;
CREATE DATABASE projet CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE projet;

DROP TABLE IF EXISTS element;
CREATE TABLE element (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  url_img VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS origin;
CREATE TABLE origin (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  url_img VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS unitclass;
CREATE TABLE unitclass (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  url_img VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS personnage;
CREATE TABLE personnage (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  element INT NOT NULL,
  unitclass INT NOT NULL,
  rarity INT NOT NULL,
  url_img VARCHAR(255) NOT NULL,
  unitclass_id INT NOT NULL,
  origin_id INT NOT NULL,
  image VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS personnage_element;
CREATE TABLE personnage_element (
  personnage_id INT NOT NULL,
  element_id INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id INT AUTO_INCREMENT PRIMARY KEY,
  username VARCHAR(255) NOT NULL,
  password_hash VARCHAR(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS user_personnage;
CREATE TABLE user_personnage (
  user_id INT NOT NULL,
  personnage_id INT NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

---

## 👤 Utilisateurs
- Mots de passe hashés
- Collection personnelle via `user_personnage`

---

## 👨‍💻 Auteur
Projet réalisé dans le cadre d’un projet web PHP / MySQL.

# Mario Wiki – Projet PHP / MySQL

Projet web réalisé en **PHP** et **MySQL**, visant à créer un **wiki interactif de l’univers Mario** avec gestion des personnages, éléments, origines, classes et collections par utilisateur.

---

## 🎯 Objectifs
- Application web en PHP
- Base de données relationnelle MySQL
- Architecture MVC simplifiée
- Authentification utilisateur
- Collection de personnages par utilisateur

---

## ⚙️ Technologies
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
  - personnage ↔ éléments (many-to-many)
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

1. Installer WAMP 
2. Lancer PHPmyadmin
3. Copier le projet dans `www/` 
4. Importer la base de données (script ci-dessous)
5. Configurer la connexion PDO
6. Accéder à :
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

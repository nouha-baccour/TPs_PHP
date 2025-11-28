## 📂 Contenu du dossier
* `login.php` : La page d'accès (Point d'entrée).
* `magasin.sql` : La base de données.


## ⚙️ Installation de la Base de Données

Avant de lancer le code, vous devez importer la base de données, sinon la connexion échouera.

1. Lancez **WAMP** 
2. Ouvrez **phpMyAdmin** dans votre navigateur (généralement `http://localhost/phpmyadmin`).
3. Créez une nouvelle base de données vide magasin.
4. Cliquez sur l'onglet **Importer** (Import).
5. Cliquez sur **Choisir un fichier** et sélectionnez le fichier `magasin.sql` situé dans ce dossier.
6. Cliquez sur **Exécuter** (Go) en bas de page.

> ✅ **Vérification :** Une fois importé, vous devriez voir les tables apparaître dans la colonne de gauche.

## 🚀 Comment tester

1. Assurez-vous que votre serveur WAMP est vert.
2. Ouvrez votre navigateur web (Chrome recommandé).
3. Accédez à l'URL suivante (adaptez le chemin selon votre dossier) :
   `http://localhost/Nom_De_Votre_Repo/TP1_Nom/login.php`

## 🔑 Identifiants de test

Pour tester la connexion, vous pouvez utiliser les utilisateurs présents dans la base de données :

* **Login / Email :** `nouha` (ou l'email enregistré dans votre table)
* **Mot de passe :** `nouha` (ou le mot de passe correspondant)

---
**Note technique :**
Vérifiez que les paramètres de connexion à la BDD dans votre code PHP (souvent dans `connexion.php` ou en haut de page) correspondent à votre configuration locale (généralement `root` sans mot de passe sur WAMP).
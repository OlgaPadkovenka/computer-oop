<?php

// Configure la connexion à la base de données
$servername = "localhost";
$username = 'root';
$password = 'root';
$databaseHandler = new PDO("mysql:host=$servername;dbname=php-config", $username, $password);

// Envoie une requête dans le serveur de base de données
$statement = $databaseHandler->query('SELECT * FROM `cpus`');
// Récupère tous les résultats de la requête
$cpus = $statement->fetchAll();

// Envoie une requête dans le serveur de base de données
$statement = $databaseHandler->query('SELECT * FROM `gpus`');
// Récupère tous les résultats de la requête
$gpus = $statement->fetchAll();

// Envoie une requête dans le serveur de base de données
$statement = $databaseHandler->query('SELECT * FROM `hdds`');
// Récupère tous les résultats de la requête
$hdds = $statement->fetchAll();

// Envoie une requête dans le serveur de base de données
$statement = $databaseHandler->query('SELECT * FROM `rams`');
// Récupère tous les résultats de la requête
$rams = $statement->fetchAll();

// Envoie une requête dans le serveur de base de données
$statement = $databaseHandler->query('SELECT * FROM `os`');
// Récupère tous les résultats de la requête
$oss = $statement->fetchAll();

// Envoie une requête dans le serveur de base de données
$statement = $databaseHandler->query('SELECT * FROM `config`');
// Récupère tous les résultats de la requête
$configs = $statement->fetchAll();

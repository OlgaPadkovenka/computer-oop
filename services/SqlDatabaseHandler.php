<?php

/**
 * Service permettant de communiquer avec une base de données SQL
 */
class SqlDatabaseHandler
{
    private PDO $pdo;

    /**
     * L'unique instance du service
     * @var 
     */
    public function __construct()
    {
        $this->pdo = new PDO("mysql:host;dbname=php-config", 'route', 'route');
    }

    /**
     * Récupère tous les enregistrements provenant d'une table donnée
     *
     * @param string $tableName Le nom de la table dans laquelle récupérer les enregistrements
     * @return array
     */
    public function fetchAll(string $tableName)
    {
        $statement = $this->pdo->query('SELECT * FROM `' . $tableName . '`');
        return $statement->fetchAll();
    }
}

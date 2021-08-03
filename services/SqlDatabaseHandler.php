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
        $this->pdo = new PDO("mysql:host=localhost;dbname=php-config", 'root', 'root');
    }

    /**
     * Récupère tous les enregistrements provenant d'une table donnée
     *
     * @param string $tableName Le nom de la table dans laquelle récupérer les enregistrements
     * @return array
     */
    public function fetchAll(string $tableName): array
    {

        $statement = $this->pdo->query('SELECT * FROM `' . $tableName . '`');
        return $statement->fetchAll();
    }

    /**
     * Récupère un enregistrement d'une table donnée en fonction de son identifiant
     *
     * @param string $tableName Le nom de la table dans laquelle récupérer l'enregistrement
     * @param integer $id L'identifiant de l'enregistrement désiré
     * @return array|null
     */
    public function fetchById(string $tableName, int $id): ?array
    {
        $statement = $this->pdo->prepare('SELECT * FROM `' . $tableName . '` WHERE `id` = :id');
        $statement->execute([':id' => $id]);
        $result = $statement->fetch();
        if ($result === false) {
            return null;
        }
        return $result;
    }
}

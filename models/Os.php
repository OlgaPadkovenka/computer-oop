<?php
// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './services/SqlDatabaseHandler.php';
// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './models/Component.php';
// Définit la classe Brand comme dépendance de ce fichier
require_once './models/Brand.php';

/**
 * Réprésente un systéme d'exploitation
 */
class Os extends Component
{

    static public function findAll(): array
    {
        // Récupère tous les résultats de la requête
        foreach (SqlDatabaseHandler::fetchAll('os') as $osData) {
            $oss[] = new Os(
                $osData['id'],
                $osData['name'],
                $osData['price'],
                null, //Brand::findById($cpuData['brand_id']),
            );
        }
        return $oss;
    }

    static public function findById(int $id)
    {
        // Configure la connexion à la base de données
        $databaseHandler = new PDO("mysql:host=localhost;dbname=php-config", 'root', 'root');
        $statement = $databaseHandler->prepare('SELECT * FROM `os`');
        $statement->execute([':id' => $id]);
        $osData = $statement->fetch();
        if ($osData === false) {
            return null;
        }
        return new Os(
            $osData['id'],
            $osData['name'],
            $osData['price'],
            null, //Brand::findById($cpuData['brand_id']),
        );
    }

    /**
     * Crée un nouveau composant
     *
     * @param integer|null $id Identifiant en base de données
     * @param string $name Nom du composant
     * @param float $price Prix du composant
     * @param Brand|null $brand Marque du composant
     */
    public function __construct(
        ?int $id = null,
        string $name = '',
        float $price = 0,
        ?int $brandId = null,
    ) {
        parent::__construct($id, $name, $price, $brandId);
    }
}

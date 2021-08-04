<?php
// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './services/SqlDatabaseHandler.php';
// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './models/Component.php';
// Définit la classe Brand comme dépendance de ce fichier
require_once './models/Brand.php';

/**
 * Réprésente un périphérique de stockage
 */
class Hdd extends Component
{
    /**
     * Capacité de stockage
     * @var integer
     */
    private int $size;
    /**
     * Type de stockage
     * 0 = disque dur
     * 1 = SSD
     * @var integer
     */
    private int $type;

    static public function findAll(): array
    {
        // Configure la connexion à la base de données
        $databaseHandler = new PDO("mysql:host=localhost;dbname=php-config", 'root', 'root');
        // Envoie une requête dans le serveur de base de données
        $statement = $databaseHandler->prepare('SELECT * FROM `hdds`');
        $hdds = [];
        // Récupère tous les résultats de la requête
        foreach (SqlDatabaseHandler::fetchAll('hdds') as $hddData) {
            $hdds[] = new Hdd(
                $hddData['id'],
                $hddData['name'],
                $hddData['price'],
                null, //Brand::findById($cpuData['brand_id']),
                $hddData['size'],
                $hddData['type']
            );
        }
        return $hdds;
    }

    /**
     * Récupère un hdd en base de données en fonction de son identifiant
     *
     * @param integer $id
     * @return void
     */
    static public function findById(int $id)
    {
        // Configure la connexion à la base de données
        $databaseHandler = new PDO("mysql:host=localhost;dbname=php-config", 'root', 'root');
        $statement = $databaseHandler->prepare('SELECT * FROM `hdds`');
        $statement->execute([':id' => $id]);
        $hddData = $statement->fetch();
        if ($hddData === false) {
            return null;
        }
        return new Hdd(
            $hddData['id'],
            $hddData['name'],
            $hddData['price'],
            null, //Brand::findById($cpuData['brand_id']),
            $hddData['size'],
            $hddData['type']
        );
    }
    /**
     * Crée un nouveau composant
     *
     * @param integer|null $id Identifiant en base de données
     * @param string $name Nom du composant
     * @param float $price Prix du composant
     * @param integer|null $brand Identifiant en base de données de la marque du composant
     * @param integer $size Capacité de stockage
     * @param integer $type Type de stockage
     */
    public function __construct(
        ?int $id = null,
        string $name = '',
        float $price = 0,
        ?int $brandId = null,
        int $size = 0,
        int $type = 0
    ) {
        parent::__construct($id, $name, $price, $brandId);
        $this->size = $size;
        $this->type = $type;
    }

    /**
     * Get capacité de stockage
     *
     * @return  integer
     */
    public function getSize(): int
    {
        return $this->size;
    }

    /**
     * Get Type de stockage
     *
     * @return  integer
     */
    public function getType(): int
    {
        return $this->type;
    }
}

<?php
// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './services/SqlDatabaseHandler.php';
// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './models/Component.php';
// Définit la classe Brand comme dépendance de ce fichier
require_once './models/Brand.php';

/**
 * Réprésente uné mémoire vive
 */
class Ram extends Component
{
    /**
     * Capacité de chaque barrette
     * @var integer
     */
    private int $chipsetSize;
    /**
     * Nombre de barrettes
     * @var integer
     */
    private int $chipsetCount;

    static public function findAll(): array
    {
        // Récupère tous les résultats de la requête
        foreach (SqlDatabaseHandler::fetchAll('rams') as $ramData) {
            $rams[] = new Ram(
                $ramData['id'],
                $ramData['name'],
                $ramData['price'],
                null, //Brand::findById($cpuData['brand_id']),
                $ramData['chipset_size'],
                $ramData['chipset_count']
            );
        }
        return $rams;
    }

    static public function findById(int $id)
    {
        // Configure la connexion à la base de données
        $databaseHandler = new PDO("mysql:host=localhost;dbname=php-config", 'root', 'root');
        $statement = $databaseHandler->prepare('SELECT * FROM `rams`');
        $statement->execute([':id' => $id]);
        $ramData = $statement->fetch();
        if ($ramData === false) {
            return null;
        }
        return new Ram(
            $ramData['id'],
            $ramData['name'],
            $ramData['price'],
            null, //Brand::findById($cpuData['brand_id']),
            $ramData['chipset_size'],
            $ramData['chipset_count']
        );
    }

    /**
     * Crée un nouveau composant
     *
     * @param integer|null $id Identifiant en base de données
     * @param string $name Nom du composant
     * @param float $price Prix du composant
     * @param Brand|null $brand Marque du composant
     * @param integer $chipsetSize Capacité de chaque barrette
     * @param integer $chipsetCount Nombre de barrettes
     */
    public function __construct(
        ?int $id = null,
        string $name = '',
        float $price = 0,
        ?int $brandId = null,
        int $chipsetSize = 0,
        int $chipsetCount = 1
    ) {
        parent::__construct($id, $name, $price, $brandId);
        $this->chipsetSize = $chipsetSize;
        $this->chipsetCount = $chipsetCount;
    }

    /**
     * Get capacité de chaque barrette
     *
     * @return  integer
     */
    public function getChipsetSize(): int
    {
        return $this->chipsetSize;
    }

    /**
     * Get nombre de barrettes
     *
     * @return  integer
     */
    public function getChipsetCount(): int
    {
        return $this->chipsetCount;
    }
}

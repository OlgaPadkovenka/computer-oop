<?php
// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './services/SqlDatabaseHandler.php';
// Définit la classe Brand comme dépendance de ce fichier
require_once './models/Brand.php';

/**
 * Réprésente uné mémoire vive
 */
class Ram
{
    /**
     * Identifiant en base de données
     * @var integer|null
     */
    private ?int $id;
    /**
     * Nom du composant
     * @var string
     */
    private string $name;
    /**
     * Prix du composant
     * @var float
     */
    private float $price;
    /**
     * Marque du composant
     * @var Brand|null
     */
    private ?Brand $brand;
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
        ?Brand $brand = null,
        int $chipsetSize = 0,
        int $chipsetCount = 1
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->brand = $brand;
        $this->chipsetSize = $chipsetSize;
        $this->chipsetCount = $chipsetCount;
    }

    /**
     * Get identifiant en base de données
     *
     * @return  integer|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get nom du composant
     *
     * @return  string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get prix du composant
     *
     * @return  float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * Get marque du composant
     *
     * @return  Brand|null
     */
    public function getBrand(): ?Brand
    {
        return $this->brand;
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

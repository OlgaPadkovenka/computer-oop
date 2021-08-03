<?php
// Définit le service SqlDatabaseHandler comme dépendance de ce fichier
require_once './services/SqlDatabaseHandler.php';
// Définit la classe Brand comme dépendance de ce fichier
require_once './models/Brand.php';

/**
 * Réprésente un périphérique de stockage
 */
class Hdd
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
     * @param Brand|null $brand Marque du composant
     * @param integer $size Capacité de stockage
     * @param integer $type Type de stockage
     */
    public function __construct(
        ?int $id = null,
        string $name = '',
        float $price = 0,
        ?Brand $brand = null,
        int $size = 0,
        int $type = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->brand = $brand;
        $this->size = $size;
        $this->type = $type;
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

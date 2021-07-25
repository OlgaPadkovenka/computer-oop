<?php

/**
 * Réprésente une carte graphique
 */
class Gpu
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
     * Quantité de mémoire
     * @var integer
     */
    private int $ram;


    /**
     * Récupère tous les cartes graphiques en base de données
     *
     * @return Gpu[]
     */
    static public function findAll(): array
    {
        // Configure la connexion à la base de données
        $databaseHandler = new PDO("mysql:host=localhost;dbname=php-config", 'root', 'root');
        // Envoie une requête dans le serveur de base de données
        $statement = $databaseHandler->query('SELECT * FROM `gpus`');
        // Récupère tous les résultats de la requête
        foreach ($statement->fetchAll() as $gpuData) {
            $gpus[] = new Gpu(
                $gpuData['id'],
                $gpuData['name'],
                $gpuData['price'],
                Brand::findById($gpuData['brand_id']),
                $gpuData['ram']
            );
        }
        return $gpus;
    }

    /**
     * Récupère un processeur en base de données en fonction de son identifiant
     *
     * @param integer $id
     * @return void
     */
    static public function findById(int $id)
    {
        // Configure la connexion à la base de données
        $databaseHandler = new PDO("mysql:host=localhost;dbname=php-config", 'root', 'root');
        $statement = $databaseHandler->prepare('SELECT * FROM `gpus`');
        $statement->execute([':id' => $id]);
        $gpuData = $statement->fetch();
        if ($gpuData === false) {
            return null;
        }
        return new Gpu(
            $gpuData['id'],
            $gpuData['name'],
            $gpuData['price'],
            Brand::findById($gpuData['brand_id']),
            $gpuData['ram']
        );
    }

    /**
     * Crée un nouveau composant
     *
     * @param integer|null $id Identifiant en base de données
     * @param string $name Nom du composant
     * @param float $price Prix du composant
     * @param Brand|null $brand Marque du composant
     * @param integer $ram Quantité de mémoire
     */
    public function __construct(
        ?int $id = null,
        string $name = '',
        float $price = 0,
        ?Brand $brand = null,
        int $ram = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->brand = $brand;
        $this->ram = $ram;
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
     * Get quantité de mémoire
     *
     * @return  integer
     */
    public function getRam(): int
    {
        return $this->ram;
    }
}

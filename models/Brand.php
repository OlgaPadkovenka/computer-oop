<?php

/**
 * Représente la marque d'un composant
 */
class Brand
{
    /**
     * Identifiant en base de données
     * @var integer|null
     */

    private ?int $id;
    /**
     * Nom de la marque
     * @var string
     */

    private string $name;
    /**
     * Nom du pays dans lequel la marque est enregistrée
     * @var string
     */
    private string $country;

    public function findById(int $id): ?Brand
    {
        // Configure la connexion à la base de données
        $databaseHandler = new PDO("mysql:host=localhost;dbname=php-config", 'root', 'root');
        $statement = $databaseHandler->prepare('SELECT * FROM `brands`
        WHERE `id` = :id
    ');
        $statement->execute([':id' => $id]);
        $brandData = $statement->fetch();
        if ($brandData === false) {
            return null;
        }
        return new Brand(
            $brandData['id'],
            $brandData['name'],
            $brandData['country']
        );
    }

    public function __construct(
        ?int $id = null,
        string $name = '',
        string $country = ''
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->country = $country;
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
     * Get nom de la marque
     *
     * @return  string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get nom du pays dans lequel la marque est enregistrée
     *
     * @return  string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}

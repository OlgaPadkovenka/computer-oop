1. Je crée un dossier services. Dedans,je crée un fichier SqlDatabaseHandler.php. Dans le fichier SqlDatabaseHandler.php, je crée une class SqlDatabaseHandler. 

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

2. J'inclus le fichier SqlDatabaseHandler.php à l'index.php
require_once './services/SqlDatabaseHandler.php';

$databaseHandler = new SqlDatabaseHandler();

3. Dans le fichier SqlDatabaseHandler.php, je crée une méthode qui va me chercher toutes les tables et qui aura comme un paramètre le nom de la table.

  public function fetchAll(string $tableName)
    {
        $statement = $this->pdo->query('SELECT * FROM `' . $tableName . '`');
        return $statement->fetchAll();
    }
}

4. 

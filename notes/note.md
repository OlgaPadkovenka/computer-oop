1. Je crée un dossier models où j'aurai les class.
2. Je crée la classe Brand avec les propriaités qui corespondent aux colonnes dans la base de donées (id, name, country) dans le fichier Brand.php.
3. Dans le fichier Cpu.php, je crée la classe Cpu (id, name, price, clock cores). Dans la classe Cpu, il y a une clée étrangère vers brand (brand_id). Je voudrais avec la classe Brand dans la classe Cpu. 
    /**
     * Marque du composant
     * @var Brand|null
     */
    private ?Brand $brand;

4. J'ajoute la class Brand dans les params er dans le constructeur

    /**
     * Crée un nouveau composant
     *
     * @param integer|null $id Identifiant en base de données
     * @param string $name Nom du composant
     * @param float $price Prix du composant
     * @param Brand|null $brand Marque du composant
     * @param integer $clock Cadence du processeur
     * @param integer $cores Nombre de coeurs
     */
    public function __construct(
        ?int $id = null,
        string $name = '',
        float $price = 0,
        ?Brand $brand = null,
        int $clock = 0,
        int $cores = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
        $this->brand = $brand;
        $this->clock = $clock;
        $this->cores = $cores;
    }

5. J'ajoute un getter vers Brand 

  /**
     * Get marque du composant
     *
     * @return  Brand|null
     */
    public function getBrand(): ?Brand
    {
        return $this->brand;
    }

6. Je crée d'autres classes de la même manière.

7. Je crée une méthode static findAll() dans la classe Cpu qui permettra chercher tous les cpus qui renvoie un tableau d'object Cpu. 
Je renvoie une requtte dans la base de donées qui recupère tous les cpus.

   static public function findAll(): array
     {
         // Configure la connexion à la base de données
         $databaseHandler = new PDO("mysql:host=localhost;dbname=php-config", 'root', 'root');

         // Envoie une requête dans le serveur de base de données
         $statement = $databaseHandler->query('SELECT * FROM `cpus`');

         // Récupère tous les résultats de la requête
         $statement->fetchAll();
    }

8. J'ajoute un foreach, et je construis un tableau cpu qui va contenir un nouvel objet Cpu qui va contenir id, name, price, null (pour l'object Brand), clock, cores. Les colonnes corespondent aux tables dans la base de donées et aux propriété de la classe.

P.S. Je mets l'objet Brand à null, parce que dans la requette (étape 7) je cherche que les cpus et pas Brand.

9. Je récupère les résultats de la requette, et je retourne l'objet cpus
   // Récupère tous les résultats de la requête
         foreach ($statement->fetchAll() as $cpuData) {
             $cpus []= new Cpu(
                 $cpuData['id'],
                 $cpuData['name'],
                 $cpuData['price'],
                  null,
                 $cpuData['clock'],
                 $cpuData['cores']
             );
         }
         return $cpus;

P.S. Si je ne fais pas return, je ne renvoie pas de valeurs (les résultats de la fonctionne). Qund je vais faire 
<?php $cpus = Cpu::findAll() ?>, $cpus sera égale à rien. 
$cpus sera égale à null.

10. Je vais dans le fichier index.php où j'inclus le fichier Cpu.php
'include './models/Cpu.php'

11. Puis, j'appelle tout les cpus.
<?php
$cpus = Cpu::findAll()
?>

Pour voir que cela marche, je peux faire un var_damp() dans Cpu.php dans la boucle foreach.

12. Je voudrais ajouter Brand à mon objet Cpu, parce que dans mon objet Cpu le champ brand est vide. Pour cela je dois adapter la requette sql. Pour le moment je cherche tous les cpu sans la marque.  

  // Envoie une requête dans le serveur de base de données
        $statement = $databaseHandler->query('SELECT
              `cpus`.*,
              `brands`.`name` as `brand_name`,
              `brands`.`country` as `brand_country`
              FROM `cpus`
              JOIN `brands` ON `cpus`.`brand_id` = `brands`.`id`
          ');

13. J'ajoute l'objet Brand (qui était null) de la méthode findAll de la class Cpu qui permet de cherher tous les cpus.

       // Récupère tous les résultats de la requête
        foreach ($statement->fetchAll() as $cpuData) {
            $cpus[] = new Cpu(
                $cpuData['id'],
                $cpuData['name'],
                $cpuData['price'],
                new Brand(
                    $cpuData['brand_id'],
                    $cpuData['brand_name'],
                    $cpuData['brand_country']
                ),
                $cpuData['clock'],
                $cpuData['cores']
            );
        }
        return $cpus;

14. La class Cpu ne marche pas comme il faut, parce que je n'ai pas importé la classe Brand dedans.

include './models/Brand.php';

15. include marche comme un copier-coller. Quand je vais inclure Brand.php dans la class Gpu(après avoir inclut dans le Cpu.php), par exemple, ca ne peut pas fonctionner, parce que le fichier sera déjà inclut dans index.php une fois, il pourra pas être inclus deuxième fois.
Pour éviter ce problème, je peux utiliser include_once. Comme ca le fichier sera inclut qu'une seule fois à index.php. 

include_once './models/Brand.php';

P.S. Pour des fichiers essentiels, je peux utiliser require_once './models/Brand.php';

16. J'affiche les cpus dans le html. Avec intval($cpuIndex) je transforme index qui était un chaîne de caractère en nombre.

    <label for="cpu">Processeur</label>
            <select name="cpu" class="form-control">
                <?php foreach ($cpus as $index => $cpu) : ?>
                    <option value="<?= $cpu->getId() ?>" <?php if (intval($cpuIndex) === $cpu->getId()) {
                                                                echo 'selected';
                                                            } ?>><?= $cpu->getName() ?></option>
                <?php endforeach; ?>
            </select>

17. Methodologie: J'ajoute une méthode dans la classe qui permet chercher l'info. J'appelle la métode dont l'info j'ai besoin. Puis, je fait une boucle à l'intérieur de la page pour l'afficher. 

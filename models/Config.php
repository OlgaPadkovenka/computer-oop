<?php

/**
 * Réprésente une configuration
 */
class Config
{
    /**
     * Identifiant en base de données
     * @var integer|null
     */
    private ?int $id;
    /**
     * Nom de la configuration
     * @var string
     */
    private string $name;
    /**
     * Processeur choisi
     * @var Cpu|null
     */
    private ?Cpu $cpu;
    /**
     * Carte graphique choisie
     * @var Gpu|null
     */
    private ?Gpu $gpu;
    /**
     * Stockage choisi
     * @var Hdd|null
     */
    private ?Hdd $hdd;
    /**
     * Système d'exploitation choisi
     * @var Os|null
     */
    private ?Os $os;
    /**
     * Mémoire vive choisie
     * @var Ram|null
     */
    private ?Ram $ram;

    /**
     * Crée une nouvelle configuration
     *
     * @param integer|null $id Identifiant en base de données
     * @param string $name Nom du composant
     * @param Cpu|null Processeur choisi
     * @param Gpu|null Carte graphique choisie
     * @param Hdd|null Stockage choisi
     * @param Os|null Système d'exploitation choisi
     * @param Ram|null Mémoire vive choisie
     */
    public function __construct(
        ?int $id = null,
        string $name = '',
        ?Cpu $cpu = null,
        ?Gpu $gpu = null,
        ?Hdd $hdd = null,
        ?Os $os = null,
        ?Ram $ram = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->cpu = $cpu;
        $this->gpu = $gpu;
        $this->hdd = $hdd;
        $this->os = $os;
        $this->ram = $ram;
    }

    /**
     * Get identifiant en base de données
     *
     * @return  integer|null
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get nom de la configuration
     *
     * @return  string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get processeur choisi
     *
     * @return  Cpu|null
     */
    public function getCpu()
    {
        return $this->cpu;
    }

    /**
     * Get carte graphique choisie
     *
     * @return  Gpu|null
     */
    public function getGpu()
    {
        return $this->gpu;
    }

    /**
     * Get stockage choisi
     *
     * @return  Hdd|null
     */
    public function getHdd()
    {
        return $this->hdd;
    }

    /**
     * Get système d'exploitation choisi
     *
     * @return  Os|null
     */
    public function getOs()
    {
        return $this->os;
    }

    /**
     * Get mémoire vive choisie
     *
     * @return  Ram|null
     */
    public function getRam()
    {
        return $this->ram;
    }
}

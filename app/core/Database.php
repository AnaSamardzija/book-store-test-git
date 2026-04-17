<?php

class Database
{
    // Parametri za konekciju na bazu podataka, vrednosti se uzimaju iz config.php
    private $host = DB_HOST;       // Adresa servera
    private $user = DB_USER;       // Korisničko ime
    private $password = DB_PASS;   // Lozinka
    private $dbname = DB_NAME;     // Naziv baze podataka
    private $dbport = DB_PORT;     // Port

    private $dbh;   // Handler konekcije na bazu
    private $stmt;  // Pripremljeni SQL upit
    private $error; // Poruka o grešci

    // Konstruktor — uspostavlja konekciju na bazu pri kreiranju objekta
    public function __construct()
    {
        // DSN (Data Source Name) string za PDO konekciju
        $dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname . ';port=' . $this->dbport;

        $options = [
            // Persistentna konekcija — sprečava uspostavljanje nove konekcije
            // svaki put kada se kreira novi objekat klase Database
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION // Greške bacati kao izuzetke
        ];

        try {
            // Kreiranje PDO instance i uspostavljanje konekcije
            $this->dbh = new PDO($dsn, $this->user, $this->password, $options);
        } catch (PDOException $e) {
            // Čuvanje i prikaz poruke o grešci
            $this->error = $e->getMessage();
            echo $this->error;
        }
    }

    // Priprema SQL upita za izvršavanje
    public function query($sql)
    {
        $this->stmt = $this->dbh->prepare($sql);
    }

    // Vezivanje vrednosti za parametar u pripremljenom upitu
    public function bind($param, $value)
    {
        $this->stmt->bindValue($param, $value);
    }

    // Izvršavanje pripremljenog upita
    public function execute()
    {
        return $this->stmt->execute();
    }

    // Vraća sve rezultate upita kao asocijativni niz
    public function results()
    {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Izvršava upit i vraća jedan jedini rezultat kao asocijativni niz
    public function result()
    {
        $this->execute();
        return $this->stmt->fetch(PDO::FETCH_ASSOC);
    }
}
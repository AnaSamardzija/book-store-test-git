<?php

class Controller
{
    // Učitava model na osnovu prosleđenog naziva
    // Na primer, za Book model:
    // ------------------------------------------
    // require_once '../app/models/Book.php';
    // return new Book;
    // ------------------------------------------
    protected function loadModel($model)
    {
        // Uključuje fajl modela iz models direktorijuma
        require_once '../app/models/' . $model . '.php';
        // Kreira i vraća instancu modela
        return new $model;
    }

    // Renderuje view na osnovu prosleđene putanje
    // Prima putanju do view-a, niz podataka i opcioni naslov stranice
    protected function renderView($viewPath, $data = [], $title = "Book Store")
    {
        // Pretvara niz $data u individualne promenljive
        extract($data);
        // Uključuje layout fajl koji renderuje view
        require_once '../app/views/layout.php';
    }
}
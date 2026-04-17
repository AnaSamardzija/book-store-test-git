<?php

class Book
{
    // Privatno svojstvo koje čuva konekciju na bazu podataka
    private $db;

    // Konstruktor — kreira novu instancu Database klase
    public function __construct()
    {
        $this->db = new Database();
    }

    // Preuzima sve knjige iz baze podataka
    public function getAllBooks()
    {
        $this->db->query("SELECT * FROM book");
        $this->db->execute();
        return $this->db->results();
    }

    // Dodaje novu knjigu u bazu podataka
    public function addBook($title, $author, $isbn)
    {
        $this->db->query("INSERT INTO book (isbn, title, author) VALUES (:isbn, :title, :author)");
        $this->db->bind(':isbn', $isbn);
        $this->db->bind(':title', $title);
        $this->db->bind(':author', $author);
        $this->db->execute();
    }

    // Ažurira postojeću knjigu u bazi podataka
    public function update($id, $title, $author, $isbn)
    {
        $this->db->query("UPDATE book SET isbn=:isbn, title=:title, author=:author WHERE id=:id");
        $this->db->bind(':isbn', $isbn);
        $this->db->bind(':title', $title);
        $this->db->bind(':author', $author);
        $this->db->bind(':id', $id);
        $this->db->execute();
    }

    // Preuzima jednu knjigu iz baze podataka na osnovu ID-a
    public function getBookById($id)
    {
        $this->db->query("SELECT * FROM book WHERE id=:id");
        $this->db->bind(':id', $id);
        $this->db->execute();
        return $this->db->result();
    }

    // Briše knjigu iz baze podataka na osnovu ID-a
    public function delete($id)
    {
        $this->db->query("DELETE FROM book WHERE id=:id");
        $this->db->bind(':id', $id);
        $this->db->execute();
    }
}
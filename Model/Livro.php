<?php
include_once('Database.php');

class LivroModel {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllBooks() {
        $sql = "SELECT * FROM livro";
        $result = $this->conn->query($sql);

        $books = [];
        while ($row = $result->fetch_assoc()) {
            $books[] = $row;
        }

        return $books;
    }

    public function addOrUpdateBook($book) {
        $titulo = $this->conn->real_escape_string($book['titulo']);
        $autor = $this->conn->real_escape_string($book['autor']);
        $categoria = $this->conn->real_escape_string($book['categoria']);
        $subcategoria = $this->conn->real_escape_string($book['subcategoria']);
        $ISBN = $this->conn->real_escape_string($book['ISBN']);
        $URLimage = $this->conn->real_escape_string($book['URLimage']);
        $sinopse = $this->conn->real_escape_string($book['sinopse']);
        $status = intval($book['status']);

        // Verifica se o livro já existe no banco
        $existingBook = $this->getBookByTitle($titulo);

        if ($existingBook) {
            // Atualiza o livro existente
            $sql = "UPDATE livro SET 
                    autor = '$autor',
                    categoria = '$categoria',
                    subcategoria = '$subcategoria',
                    ISBN = '$ISBN',
                    URLimagem = '$URLimage',
                    sinope = '$sinopse',
                    status = $status
                    WHERE titulo = '$titulo'";
        } else {
            // Adiciona um novo livro
            $sql = "INSERT INTO livro (titulo, autor, categoria, subcategoria, ISBN, URLimagem, sinope, status)
                    VALUES ('$titulo', '$autor', '$categoria', '$subcategoria', '$ISBN', '$URLimage', '$sinopse', $status)";
        }

        $this->conn->query($sql);
    }

    public function removeBook($titulo) {
        $titulo = $this->conn->real_escape_string($titulo);
        $sql = "DELETE FROM livro WHERE titulo = '$titulo'";
        $this->conn->query($sql);
    }

    private function getBookByTitle($titulo) {
        $titulo = $this->conn->real_escape_string($titulo);
        $sql = "SELECT * FROM livro WHERE titulo = '$titulo'";
        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }
}

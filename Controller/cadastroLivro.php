<?php

include 'LivroModel.php';
include_once('../Model/Database.php');
include_once('../Model/Livro.php');

$database = new Database();


class LivroController {
    private $livroModel;

    public function __construct($conn) {
        $this->livroModel = new LivroModel($conn);
    }

    public function getAllBooks() {
        return $this->livroModel->getAllBooks();
    }

    public function addOrUpdateBook($book) {
        $this->livroModel->addOrUpdateBook($book);
    }

    public function removeBook($titulo) {
        $this->livroModel->removeBook($titulo);
    }
}

// Exemplo de uso
$conn = new mysqli("localhost", "usuario", "senha", "bibliotec");
$livroController = new LivroController($conn);

// Obtendo todos os livros
$allBooks = $livroController->getAllBooks();

// Adicionando ou atualizando um livro
$book = [
    'status' => $_POST['status'],
    'titulo' => $_POST['titulo'],
    'autor' => $_POST['autor'],
    'categoria' => $_POST['categoria'],
    'subcategoria' => $_POST['subcategoria'],
    'ISBN' => $_POST['ISBN'],
    'URLimage' => $_POST['URLimage'],
    'sinopse' => $_POST['sinopse']
];
$livroController->addOrUpdateBook($book);

// Removendo um livro
$tituloParaRemover = "Título do Livro a Remover";
$livroController->removeBook($tituloParaRemover);

<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    exit;
}

include 'conexao.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    $stmt = $conn->prepare("SELECT * FROM hotel");
    $stmt->execute();
    $hotel = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($hotel);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $numero = $_POST['numero'];
    $tipo = $_POST['tipo'];
    $disponivel = $_POST['disponivel'];


    $stmt = $conn->prepare("INSERT INTO hotel (numero, tipo, disponivel) VALUES (:numero, :tipo, :disponivel)");
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':tipo', $tipo);
    $stmt->bindParam(':disponivel', $disponivel);


    if($stmt->execute()){
        echo "Reserva criado com sucesso!!!";
    } else {
        echo"Erro ao criar reserva :((";
    }
}

if($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM hotel WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if($stmt->execute()){
        echo "Reserva excluido com sucesso!!!";
    }else{
        echo"Erro ao excluir reserva";
    }
}
if($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])){
    parse_str(file_get_contents("php://input"), $_PUT);

    $id = $_GET['id'];
    $novoNumero = $_PUT['numero'];
    $novoTipo = $_PUT['tipo'];
    $novoDisponivel = $_PUT['disponivel'];

    $stmt = $conn->prepare("UPDATE hotel SET numero = :numero, tipo = :tipo, disponivel = :disponivel WHERE id = :id");
    $stmt->bindParam(':numero', $novoNumero);
    $stmt->bindParam(':tipo', $novoTipo);
    $stmt->bindParam(':disponivel', $novoDisponivel);
    $stmt->bindParam(':id', $id);

    if($stmt->execute()){
        echo "Reserva atualizado!";
    } else {
        echo "Erro ao atualizar reserva...";
    }

}
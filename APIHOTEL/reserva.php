<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');

header('Access-Control-Allow-Headers: Content-Type');

if($_SERVER['REQUEST_METHOD'] === 'OPTIONS'){
    exit;
}

include 'conexao.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){

    $stmt = $conn->prepare("SELECT * FROM reserva");
    $stmt->execute();
    $Hotel = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($Hotel);
}

if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $nomeCliente = $_POST['nomeCliente'];
    $numeroQuarto = $_POST['numeroQuarto'];
    $checkIn = $_POST['checkIn'];
    $checkOut = $_POST['checkOut'];

    $stmt = $conn->prepare("INSERT INTO reserva (nomeCliente, numeroQuarto, checkIn, checkOut) VALUES(:numeroQuarto, :numeroQuarto, :checkIn, :checkOut)");
    $stmt->bindParam(':nomeCliente', $nomeCliente);
    $stmt->bindParam(':numeroQuarto', $numeroQuarto);
    $stmt->bindParam(':checkIn', $checkIn);
    $stmt->bindParam(':checkOut', $checkOut);
  
    if($stmt->execute()){
        echo "Reserva adicionada com sucesso!";
    } else {
        echo"Este quarto já está reservado.";
    }
}

if($_SERVER['REQUEST_METHOD'] === 'DELETE' && isset($_GET['id'])){
    $id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM quartos WHERE id = :id");
    $stmt->bindParam(':id', $id);

    if($stmt->execute()){
        echo "Reserva excluida com sucesso!";
    }else{
        echo"Erro ao excluir a reserva.";
    }
}

if($_SERVER['REQUEST_METHOD'] === 'PUT' && isset($_GET['id'])){
    parse_str(file_get_contents("php://input"), $_PUT);

    $id = $_GET['id'];
    $novoCliente = $_PUT['nomeCliente'];
    $novoQuarto = $_PUT['numeroQuarto'];
    $novoCheckIn = $_PUT['checkIn'];
    $novoCheckOut = $_PUT['checkOut'];

    $stmt = $conn->prepare("UPDATE reserva SET numeroCliente = :numeroCliente, numeroQuarto = :numeroQuarto, checkIn = :checkIn, checkOut = :checkOut WHERE id = :id");
    $stmt->bindParam(':nomeCliente', $novoCliente);
    $stmt->bindParam(':numeroQuarto', $novoQuarto);
    $stmt->bindParam(':checkIn', $novoCheckIn);
    $stmt->bindParam(':checkOut', $novoCheckOut);
    $stmt->bindParam(':id', $id);

    if($stmt->execute()){
        echo "Reserva atualizada!";
    } else {
        echo "Erro ao atualizar a reserva.";
    }

}

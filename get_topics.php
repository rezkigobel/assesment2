<?php
// Koneksi ke database
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'ecoscore';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die(json_encode([
        'status' => 'error',
        'message' => 'Koneksi ke database gagal: ' . $conn->connect_error
    ]));
}

// Ambil data dari formulir
$topic_id = isset($_POST['topic_id']) ? intval($_POST['topic_id']) : 0;
$reply = isset($_POST['reply']) ? $_POST['reply'] : '';

header('Content-Type: application/json'); // Menandakan respons adalah JSON

if ($topic_id > 0 && !empty($reply)) {
    $query = "INSERT INTO replies (topic_id, reply) VALUES ('$topic_id', '$reply')";
    if ($conn->query($query) === TRUE) {
        echo json_encode([
            'status' => 'success',
            'message' => 'Balasan berhasil ditambahkan.'
        ]);
    } else {
        echo json_encode([
            'status' => 'error',
            'message' => 'Gagal menambahkan balasan: ' . $conn->error
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Input tidak valid.'
    ]);
}

$conn->close();
?>


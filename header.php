<?php
session_start();
$isConnected = isset($_SESSION['user_id']);
echo json_encode(['isConnected' => $isConnected]);
?>
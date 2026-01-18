<?php

class Database {

  private $host = "localhost";
  private $db   = "toko_iphone";
  private $user = "root";
  private $pass = "";
  protected $conn;

  public function __construct() {
    try {
      $this->conn = new PDO(
        "mysql:host={$this->host};dbname={$this->db}",
        $this->user,
        $this->pass
      );
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
      die("Koneksi database gagal: " . $e->getMessage());
    }
  }
}

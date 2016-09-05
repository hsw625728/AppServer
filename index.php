<?php
class RedeemAPI {
    private $db;
 
    // Constructor - open DB connection
    function __construct() {
        $this->db = new mysqli('127.0.0.1', 'root', 'spider', 'AppServer');
        $this->db->autocommit(FALSE);
    }
 
    // Destructor - close DB connection
    function __destruct() {
        $this->db->close();
    }
 
    // Main method to redeem a code
    function redeem() {
        // Print all codes in database
        $stmt = $this->db->prepare('SELECT id, pass FROM as_account');
        $stmt->execute();
        $stmt->bind_result($id, $pass);
        while ($stmt->fetch()) {
            echo "ID:$id   PASS:$pass";
        }
        $stmt->close();
    }
}

$api = new RedeemAPI;
$api->redeem();
?>
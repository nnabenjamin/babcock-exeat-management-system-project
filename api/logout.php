<?php
session_start(); // Start sessions

require dirname(__FILE__) . '/db_connection/db_conn.php'; // Import db conn script

if (isset($_SESSION['user_id']) && isset($_SESSION['name']) && isset($_SESSION['email']) && isset($_SESSION['role'])) {
    session_destroy(); // Destroy all sessions
}
header("Location: http://localhost/promise_project/index.php");

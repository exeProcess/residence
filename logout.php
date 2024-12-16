<?php
function logout() {
    // Start the session if it hasn't already started
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Unset all session variables
    $_SESSION = array();

    // Destroy the session cookie (if it exists)
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }

    // Destroy the session
    session_destroy();

    // Redirect to a login page or home page
    header("Location: index.php");
    exit;
}

// Call the function when needed
logout();

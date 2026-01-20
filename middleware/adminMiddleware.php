<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}


if (!isset($_SESSION['user']['role']) || $_SESSION['user']['role'] !== 'admin') {
    http_response_code(403);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>403 Forbidden</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Barlow:wght@400;600&display=swap");
            * { 
                margin: 0; 
                padding: 0; 
                box-sizing: border-box; 
                font-family: "Barlow", sans-serif; 
            }
            body { 
                text-align: center; 
                height: 100vh; display: 
                flex; align-items: center; 
                justify-content: center; 
                background: #f4f6f9; color: #333; 
            }
        </style>
    </head>
    <body>
        <h1>Error 403: You are not authorized to visit that page!</h1>
    </body>
    </html>
<?php
    exit();
}
?>
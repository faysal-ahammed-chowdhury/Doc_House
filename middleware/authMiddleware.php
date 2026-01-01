<?php
session_start();

if (!isset($_SESSION['user'])) {
    http_response_code(403);
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>403 Forbidden</title>
        <style>
            @import url("https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap");

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                font-family: "Barlow", sans-serif;
            }

            body {
                text-align: center;
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
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

<?php
$environmentFile = "environment.txt";
$environment = "UNKNOWN";

if (file_exists($environmentFile)) {
    $environment = trim(file_get_contents($environmentFile));
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>PHP DevOps Demo</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            background: #f4f6f9;
        }
        .box {
            max-width: 800px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.08);
        }
        .env {
            padding: 12px 16px;
            margin-bottom: 20px;
            background: #e8f0fe;
            border-left: 5px solid #2b6cb0;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="box">
        <div class="env">Environment: <?php echo htmlspecialchars($environment); ?></div>
        <h1>Student Results Portal</h1>
        <p>Module: CSY3056 DevOps Demo</p>
        <p>This page is being promoted through Dev, Test, Staging, and Production using Jenkins.</p>
    </div>
</body>
</html>
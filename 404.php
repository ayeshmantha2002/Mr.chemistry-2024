<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Not Found - 404 Error</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        :root {
            --shadow: #00000030;
            --dark-shadow: #00000080;
            --primary-color: #00a088;
            --secondary-color: #333;
            --bg-color: #f0f0f0;
            --container-bg: #fff;
            --font-family: Arial, sans-serif;
        }

        body {
            font-family: var(--font-family);
            background-color: var(--bg-color);
            text-align: center;
            padding: 50px;
            margin: 0;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            box-sizing: border-box;
        }

        .container {
            max-width: 600px;
            width: 100%;
            background-color: var(--container-bg);
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.5);
            box-sizing: border-box;
        }

        .logo {
            max-width: 100px;
            margin-bottom: 20px;
            border-radius: 50%;
            box-shadow: 0 10px 10px var(--shadow);
        }

        h1 {
            font-size: 3em;
            margin-bottom: 20px;
            color: var(--primary-color);
        }

        p {
            font-size: 1.2em;
            margin-bottom: 20px;
            color: var(--secondary-color);
        }

        a {
            color: var(--primary-color);
            text-decoration: none;
            font-weight: bold;
        }

        .company-name {
            font-size: 1.5em;
            margin-bottom: 30px;
            color: #000;
        }

        a:hover {
            text-decoration: underline;
        }

        @media (max-width: 768px) {
            body {
                padding: 20px;
            }

            .container {
                padding: 20px;
            }

            h1 {
                font-size: 2em;
            }

            p {
                font-size: 1em;
            }

            .company-name {
                font-size: 1.2em;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            h1 {
                font-size: 1.8em;
            }

            p {
                font-size: 0.9em;
            }

            .company-name {
                font-size: 1em;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <img src="assect/img/icon/logo.png" alt="Your Logo" class="logo">
        <div class="company-name">Mr.ChemistrY</div>
        <div class="content">
            <h1>404 - Page Not Found</h1>
            <p>The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.</p>
            <p>Go to <a href="/">Home Page</a></p>
        </div>
    </div>
</body>

</html>
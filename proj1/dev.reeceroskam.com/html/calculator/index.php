<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reece's WebServer - Calculator</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0d1117;
            color: #c9d1d9;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            flex-direction: column;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 15px 40px;
            background-color: #161b22;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        #title {
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            color: #58a6ff;
            margin-right: 20px;
            margin-left: 20px;
        }

        #clock {
            font-size: 18px;
            color: #8b949e;
            margin-left: 20px;
        }

        #translator-button, #calculator-button {
            padding: 8px 16px;
            background-color: #58a6ff;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 20px;
        }

        #translator-button:hover, #calculator-button:hover {
            background-color: #4a90e2;
        }

        .right-side {
            display: flex;
            align-items: center;
        }

        .content {
            margin-top: 100px;
            text-align: center;
        }

        input[type="text"] {
            padding: 10px;
            border: none;
            border-radius: 5px;
            width: 200px;
            background-color: #161b22;
            color: #c9d1d9;
            margin-bottom: 15px;
            font-size: 16px;
        }

        button[type="button"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #58a6ff;
            color: #ffffff;
            cursor: pointer;
            width: 200px;
            font-size: 16px;
        }

        button[type="button"]:hover {
            background-color: #4a90e2;
        }
    </style>
</head>
<body>

<header>
    <div style="display: flex; align-items: center;">
        <div id="title">Reece's WebServer</div>
        <div id="clock"></div>
    </div>
    <div class="right-side">
        <button id="translator-button">Translator</button>
        <button id="calculator-button">Calculator</button>
    </div>
</header>

<div class="content">
    <h1>Calculator</h1>
    <input type="text" id="expression" placeholder="Enter expression" required>
    <button type="button" id="calculate-btn">=</button>
</div>

<script>
    function updateClock() {
        const clockElement = document.getElementById('clock');
        const now = new Date();
        let hours = now.getHours();
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12;
        hours = hours ? hours : 12;

        clockElement.textContent = `${hours}:${minutes}:${seconds} ${ampm}`;
    }

    setInterval(updateClock, 1000);
    updateClock();

    const titleElement = document.getElementById('title');
    titleElement.addEventListener('click', () => {
        window.location.href = '/';
    });

    const translatorButton = document.getElementById('translator-button');
    translatorButton.addEventListener('click', () => {
        window.location.href = '/chatgpt';
    });

    const calculatorButton = document.getElementById('calculator-button');
    calculatorButton.addEventListener('click', () => {
        window.location.href = '/calculator';
    });

    // Handle the calculate button click
    document.getElementById('calculate-btn').addEventListener('click', function() {
        const expression = document.getElementById('expression').value;
        
        // Send the expression via AJAX to the backend
        const xhr = new XMLHttpRequest();
        xhr.open('POST', '/cgi-bin/calculator', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (xhr.status === 200) {
                // Update the input field with the result
                document.getElementById('expression').value = xhr.responseText;
            } else {
                console.error('Error calculating the expression');
            }
        };
        xhr.send('expression=' + encodeURIComponent(expression));
    });
</script>

</body>
</html>

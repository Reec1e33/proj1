<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reece's WebServer - Advanced Calculator</title>
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
            margin-right: 10px;
        }

        #translator-button:hover, #calculator-button:hover {
            background-color: #4a90e2;
        }

        .content {
            margin-top: 100px;
            text-align: center;
        }

        #calculator {
            display: grid;
            grid-template-columns: repeat(4, 80px);
            grid-gap: 10px;
            margin-top: 20px;
        }

        input[type="text"] {
            grid-column: span 4;
            padding: 10px;
            font-size: 24px;
            text-align: right;
            background-color: #161b22;
            border: none;
            color: #c9d1d9;
            border-radius: 5px;
        }

        button {
            padding: 15px;
            font-size: 18px;
            background-color: #161b22;
            color: #c9d1d9;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #4a90e2;
        }

        #result {
            margin-top: 20px;
            font-size: 18px;
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
    </div>
</header>

<div class="content">
    <h1>Calculator</h1>
    <form id="calc-form" action="/cgi-bin/calculator" method="post">
        <div id="calculator">
            <input type="text" id="calc-input" name="calcInput" readonly>
            <button type="button" value="1">1</button>
            <button type="button" value="2">2</button>
            <button type="button" value="3">3</button>
            <button type="button" value="+">+</button>
            <button type="button" value="4">4</button>
            <button type="button" value="5">5</button>
            <button type="button" value="6">6</button>
            <button type="button" value="-">-</button>
            <button type="button" value="7">7</button>
            <button type="button" value="8">8</button>
            <button type="button" value="9">9</button>
            <button type="button" value="*">*</button>
            <button type="button" value="C">C</button>
            <button type="button" value="0">0</button>
            <button type="button" value="=">=</button>
            <button type="button" value="/">/</button>
        </div>
        <input type="hidden" id="calc-result" name="calcResult">
    </form>

    <div id="result"></div>
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

    // Calculator functionality
    const inputField = document.getElementById('calc-input');
    const buttons = document.querySelectorAll('#calculator button');
    const form = document.getElementById('calc-form');
    let expression = '';

    buttons.forEach(button => {
        button.addEventListener('click', () => {
            const value = button.value;
            if (value === 'C') {
                expression = '';
                inputField.value = '';
            } else if (value === '=') {
                // Submit form to the backend to calculate the result
                document.getElementById('calc-result').value = expression;
                form.submit();
            } else {
                expression += value;
                inputField.value = expression;
            }
        });
    });

    // Fetch result from server and display it
    const urlParams = new URLSearchParams(window.location.search);
    const result = urlParams.get('result');
    if (result) {
        inputField.value = result;
    }
</script>

</body>
</html>

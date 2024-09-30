<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reece's WebServer</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0d1117; /* GitHub dark background */
            color: #c9d1d9; /* GitHub light gray text */
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 15px 40px; /* Added padding to move away from edges */
            background-color: #161b22; /* Darker background for header */
            display: flex;
            align-items: center;
            justify-content: space-between; /* Add space between title and right items */
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        #title {
            font-size: 24px;
            font-weight: bold;
            cursor: pointer;
            color: #58a6ff; /* GitHub link color */
            margin-right: 20px;
            margin-left: 20px; /* Added margin to move the title to the right */
        }

        #clock {
            font-size: 18px;
            color: #8b949e;
            margin-left: 20px; /* Add space between title and clock */
        }

        /* Add button style */
        #translator-button {
            padding: 8px 16px;
            background-color: #58a6ff; /* GitHub link color */
            color: #ffffff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-right: 40px; /* Add margin from the right edge */
        }

        #translator-button:hover {
            background-color: #4a90e2; /* Darker blue on hover */
        }

        .right-side {
            display: flex;
            align-items: center;
        }
    </style>
</head>
<body>

<header>
    <div style="display: flex; align-items: center;">
        <div id="title">Reece's WebServer</div>
        <div id="clock"></div> <!-- Clock placed 20px to the right of title -->
    </div>
    <div class="right-side">
        <button id="translator-button">Translator</button> <!-- Button aligned to right with space -->
    </div>
</header>

<script>
    // Function to update the clock every second
    function updateClock() {
        const clockElement = document.getElementById('clock');
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        clockElement.textContent = `${hours}:${minutes}:${seconds}`;
    }

    // Initialize the clock and update every second
    setInterval(updateClock, 1000);
    updateClock(); // Call once to initialize immediately

    // Refresh page when the title is clicked
    const titleElement = document.getElementById('title');
    titleElement.addEventListener('click', () => {
        location.reload();
    });

    // Button event listener to navigate to the translator page
    const translatorButton = document.getElementById('translator-button');
    translatorButton.addEventListener('click', () => {
        window.location.href = '/chatgpt'; // Redirect to translator page
    });
</script>

</body>
</html>

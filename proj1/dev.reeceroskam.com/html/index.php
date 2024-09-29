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

       

        #title.contract {
            animation: contract 0.5s;
        }

        @keyframes contract {
            0% {
                transform: scale(1);
            }
            50% {
                transform: scale(0.9); /* Contract a bit */
            }
            100% {
                transform: scale(1);
            }
        }

        #clock {
            font-size: 18px;
            color: #8b949e; /* Slightly dimmed clock text */
        }
    </style>
</head>
<body>

<header>
    <div id="title">Reece's WebServer</div>
    <div id="clock"></div>
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

    // Refresh page when the title is clicked and add a contract animation
    const titleElement = document.getElementById('title');
    titleElement.addEventListener('click', () => {
        // Add contract class for animation
        titleElement.classList.add('contract');

        // Remove the contract class after animation finishes
        setTimeout(() => {
            titleElement.classList.remove('contract');
        }, 500);

        // Refresh the page
        setTimeout(() => {
            location.reload();
        }, 500);
    });
</script>

</body>
</html>

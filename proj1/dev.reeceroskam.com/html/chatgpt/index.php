<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reece's WebServer  Translator App</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            background-color: #0d1117;
            color: #c9d1d9;
            font-family: 'Roboto', sans-serif;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        header {
            position: fixed;
            top: 0;
            width: 100%;
            padding: 15px 40px;
            background-color: #161b22;
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
            transition: transform 0.2s ease; /* Add smooth animation for contraction */
        }

        #title.contract {
            transform: scale(0.9); /* Contract the title slightly */
        }

        #clock {
            font-size: 18px;
            color: #8b949e;
        }

        /* Center content */
        .content {
            margin-top: 150px;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        textarea {
            padding: 10px;
            background-color: #161b22;
            color: #c9d1d9;
            border: none;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
            height: 100px;
            width: 300px;
        }

        select {
            padding: 10px;
            background-color: #161b22;
            color: #c9d1d9;
            border: none;
            border-radius: 5px;
            margin-bottom: 15px;
            font-size: 16px;
            width: 300px;
        }

        button {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #58a6ff;
            color: #ffffff;
            cursor: pointer;
            width: 300px;
            font-size: 16px;
            transition: transform 0.2s ease; /* Add smooth animation for contraction */
        }

        button:hover {
            background-color: #4a90e2;
        }

        button.contract {
            transform: scale(0.9); /* Contract the button slightly */
        }

        #translation-result {
            margin-top: 20px;
            padding: 10px;
            width: 300px;
            background-color: #161b22;
            border-radius: 5px;
            color: #c9d1d9;
            font-size: 16px;
            border: 1px solid #30363d;
            min-height: 80px;
            text-align: left;
        }

        h1 {
            color: #c9d1d9;
            font-size: 28px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<header>
    <div id="title">Reece's WebServer</div>
    <div id="clock"></div>
</header>

<div class="content">
    <h1>Translation App</h1>

    <form id="translate-form">
        <textarea id="phrase" name="phrase" placeholder="Enter your phrase here"></textarea>

        <select id="language" name="language">
            <option value="Spanish">Spanish</option>
            <option value="French">French</option>
            <option value="Italian">Italian</option>
            <option value="Rastafarian">Rastafarian</option>
            <option value="Alphabro">Alphabro</option>
            <option value="Passive Aggressive">Passive Aggressive</option>
        </select>

        <button type="submit" id="submit-button">Translate</button>
    </form>

    <div id="translation-result">Your translation will appear here...</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function updateClock() {
        const clockElement = document.getElementById('clock');
        const now = new Date();
        let hours = now.getHours();
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        const ampm = hours >= 12 ? 'PM' : 'AM';

        hours = hours % 12; // Convert to 12-hour format
        hours = hours ? hours : 12; // If hours is 0 (midnight), make it 12

        clockElement.textContent = `${hours}:${minutes}:${seconds} ${ampm}`;
    }

setInterval(updateClock, 1000);
updateClock(); // Initialize the clock immediately


    // Handle form submission using AJAX
    $('#translate-form').on('submit', function(event) {
        event.preventDefault();  // Prevent form refresh

        var phrase = $('#phrase').val();
        var language = $('#language').val();

        // Add contract class to the button for animation
        $('#submit-button').addClass('contract');

        // Remove the contract class after animation finishes
        setTimeout(() => {
            $('#submit-button').removeClass('contract');
        }, 200);  // Remove the class after the animation

        $.ajax({
            url: 'https://dev.chatgpt.reeceroskam.com',  // API endpoint
            type: 'POST',
            data: {
                phrase: phrase,
                language: language
            },
            success: function(response) {
                $('#translation-result').html('<p><strong>Translation:</strong> ' + response + '</p>');
            },
            error: function() {
                $('#translation-result').html('<p>Error occurred while processing your request.</p>');
            }
        });
    });

    // Handle title click to redirect based on the hostname
    const titleElement = document.getElementById('title');
    titleElement.addEventListener('click', () => {
        // Add contract class for animation
        titleElement.classList.add('contract');

        // Remove the contract class after animation finishes
        setTimeout(() => {
            titleElement.classList.remove('contract');
        }, 200);

        // Redirect based on current hostname (dev or production)
        const hostname = window.location.hostname;
        if (hostname === 'dev.reeceroskam.com') {
            window.location.href = 'https://dev.reeceroskam.com';  // Redirect to dev site
        } else {
            window.location.href = 'https://reeceroskam.com';  // Redirect to production site
        }
    });
</script>

</body>
</html>

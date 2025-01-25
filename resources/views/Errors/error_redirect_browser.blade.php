
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login URL Redirect</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background-color: #f4f4f4;
        }
        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }
        button {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover {
            background-color: #0056b3;
        }
        .url-box {
            background: #f9f9f9;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
            margin-bottom: 10px;
            word-wrap: break-word;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Login URL</h2>

        <h5>Unfortunately, this app does not allow redirects.Please copy first, then open the browser and paste it.</h5>

        <!-- URL Display -->
        <div id="loginUrl" class="url-box">{{route('login')}}</div>

        <!-- Copy Button -->
        <button onclick="copyToClipboardFallback()">Copy Login URL</button>

        <!-- Safari Redirect Button -->
        <button onclick="openInSafari()">Open Browser</button>
    </div>

    <script>
        // Copy URL to Clipboard
        function copyToClipboardFallback() {
            const url = document.getElementById('loginUrl').textContent;
            const tempInput = document.createElement('input');
            tempInput.value = url;
            document.body.appendChild(tempInput);
            tempInput.select();
            document.execCommand('copy');
            document.body.removeChild(tempInput);
            alert('Login URL copied to clipboard!');
        }


        // Open URL in Safari
        function openInSafari() {
            const url = document.getElementById('loginUrl').textContent;
            // x-web-search protokolü ile yönlendirme
            window.location.href = "x-web-search://";
        }
    </script>
</body>
</html>

<!DOCTYPE html>
<html>

<head>
    <title>Chatbot Jamu</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<body>
    <h2>Chat dengan Bot Jamu</h2>
    <form id="chat-form">
        <input type="text" id="message" name="message" placeholder="Apa keluhan Anda?" required>
        <button type="submit">Kirim</button>
    </form>
    <div id="response"></div>

    <script>
        document.getElementById('chat-form').addEventListener('submit', function(e) {
            e.preventDefault();
            let message = document.getElementById('message').value;

            fetch('/chatbot/message', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                            'content')
                    },
                    body: JSON.stringify({
                        message: message
                    })
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('response').innerHTML = '<p>' + data.response + '</p>';
                });
        });
    </script>
</body>

</html>

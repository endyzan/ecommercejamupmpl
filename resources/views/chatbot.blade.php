<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
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

    <script defer>
        document.addEventListener('DOMContentLoaded', () => {
            const form = document.getElementById('chat-form');
            const messageInput = document.getElementById('message');
            const responseDiv = document.getElementById('response');
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const message = messageInput.value;
                console.log('Input object:', message);

                // fetch('/chatbot/message', {
                //         method: 'POST',
                //         headers: {
                //             'Content-Type': 'application/json',
                //             'X-CSRF-TOKEN': csrfToken
                //         },
                //         body: JSON.stringify({
                //             message
                //         })
                //     })
                //     .then(response => {
                //         if (!response.ok) {
                //             throw new Error('Network response was not ok');
                //         }
                //         return response.json();
                //     })
                //     .then(data => {
                //         responseDiv.textContent = data.response || 'Bot tidak memberikan respon.';
                //         messageInput.value = ''; // clear input
                //     })
                //     .catch(error => {
                //         responseDiv.textContent = 'Terjadi kesalahan: ' + error.message;
                //     });
            });
        });
    </script>
</body>

</html>

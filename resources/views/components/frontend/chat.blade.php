<!-- Chat Widget Styles -->
<style>
    .chat-toggle-button {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background-color: #25D366;
        color: white;
        padding: 12px 16px;
        border-radius: 50%;
        border: none;
        cursor: pointer;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        z-index: 9999;
        font-size: 18px;
    }

    .chat-popup {
        display: none;
        position: fixed;
        bottom: 80px;
        right: 20px;
        width: 320px;
        background: white;
        border: 1px solid #ccc;
        border-radius: 12px;
        z-index: 9999;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
    }

    .chat-header {
        background-color: #25D366;
        color: white;
        padding: 10px 16px;
        border-radius: 12px 12px 0 0;
        display: flex;
        align-items: center;
    }

    .chat-header img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 12px;
    }

    .chat-body {
        height: 300px;
        overflow-y: auto;
        padding: 10px;
        background-color: #f9f9f9;
    }

    .chat-footer {
        display: flex;
        border-top: 1px solid #ccc;
        padding: 8px;
        background-color: #fff;
        border-radius: 0 0 12px 12px;
    }

    .chat-footer input {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 8px;
        margin-right: 8px;
        background-color: #f0f0f0;
    }

    .chat-footer button {
        background-color: #25D366;
        color: white;
        border: none;
        padding: 10px 15px;
        border-radius: 8px;
        cursor: pointer;
    }

    .chat-message {
        display: flex;
        margin-bottom: 12px;
        align-items: flex-start;
    }

    .chat-message.admin img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-right: 8px;
    }

    .chat-message .message-content {
        max-width: 80%;
        padding: 10px 12px;
        border-radius: 12px;
    }

    .chat-message.admin .message-content {
        background-color: #d1f5d3;
        margin-left: 8px;
    }

    .chat-message.user .message-content {
        background-color: #f1f1f1;
        margin-left: auto;
    }

</style>

<!-- Chat Toggle Button -->
<button id="chat-toggle" class="chat-toggle-button">💬</button>

<!-- Chat Popup -->
<div id="chat-popup" class="chat-popup">
    <div class="chat-header">
        <img src="https://www.pngmart.com/files/21/Admin-Profile-Vector-PNG-File.png" alt="Admin">
        <strong>Chat Admin</strong>
    </div>
    <div id="chat-body" class="chat-body"></div>
    <div class="chat-footer">
        <input type="text" id="message-input" placeholder="Tulis pesan...">
        <button id="send-btn">Kirim</button>
    </div>
</div>

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<!-- Chat Script -->
<script>
    const chatToggle = document.getElementById('chat-toggle');
    const chatPopup = document.getElementById('chat-popup');
    const messageInput = document.getElementById('message-input');
    const chatBody = document.getElementById('chat-body');
    const sendButton = document.getElementById('send-btn');
    const adminProfileUrl = 'https://www.pngmart.com/files/21/Admin-Profile-Vector-PNG-File.png';
    let lastMessageId = 0;

    chatToggle.addEventListener('click', () => {
        chatPopup.style.display = chatPopup.style.display === 'none' || chatPopup.style.display === '' ? 'block' : 'none';
        loadMessages(); // Refresh messages on open
    });

    sendButton.addEventListener('click', () => sendMessage());
    messageInput.addEventListener('keydown', (event) => {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault();
            sendMessage();
        }
    });

    function sendMessage() {
        const message = messageInput.value.trim();
        if (!message) return;

        fetch('/chat/send', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({ message, receiver_id: 1 })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'sent' && data.message) {
                appendMessage(data.message.message, data.message.is_admin);
                messageInput.value = '';
                lastMessageId = data.message.id;
            }
        })
        .catch(console.error);
    }

    function appendMessage(message, isAdmin) {
        const messageElement = document.createElement('div');
        messageElement.classList.add('chat-message', isAdmin ? 'admin' : 'user');
        messageElement.innerHTML = isAdmin
            ? `<img src="${adminProfileUrl}" alt="Admin"><div class="message-content">${message}</div>`
            : `<div class="message-content">${message}</div>`;
        chatBody.appendChild(messageElement);
        chatBody.scrollTop = chatBody.scrollHeight;
    }

    function loadMessages() {
        fetch(`/get-messages?last_id=${lastMessageId}`)
        .then(response => response.json())
        .then(data => {
            if (data.messages && Array.isArray(data.messages)) {
                data.messages.forEach(msg => {
                    appendMessage(msg.message, msg.is_admin);
                    lastMessageId = msg.id;
                });
            }
        })
        .catch(console.error);
    }

    // Polling untuk cek pesan baru
    setInterval(loadMessages, 5000); // Cek pesan baru setiap 5 detik

    // Load initial messages
    loadMessages();
</script>
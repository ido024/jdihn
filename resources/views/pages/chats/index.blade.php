@extends('layouts.admin')
@section('admin-content')

<div id="loading-indicator" style="display:none;">Loading...</div>
<style>
    #chat-box {
        height: calc(100vh - 300px);
        /* Atur tinggi sesuai kebutuhan */
        overflow-y: auto;
        /* Pastikan scroll vertical diaktifkan */
    }

    ``` #chat-list {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    /* Untuk pesan admin */
    .chat-item.admin .chat-img {
        float: left;
    }

    /* Untuk pesan user (maksudnya, pengirim lain) */
    .chat-item.user .chat-img {
        float: right;
    }

    /* Gambar profil pengirim di kanan untuk admin */
    .chat-item.odd .chat-img {
        float: right;
        /* Gambar profil admin di kanan */
    }

    .chat-item.odd .chat-content {
        text-align: right;
        /* Teks di kanan untuk admin */
    }

    ```

</style>

<!-- Sidebar Chat (Left) -->

<div class="left-part bg-white fixed-left-part">
    <a class="ti-menu ti-close btn btn-success show-left-part d-block d-md-none" href="javascript:void(0)"></a>
    <div class="p-15">
        <h4>Chat Sidebar</h4>
    </div>
    <div class="scrollable position-relative" style="height:100%;">
        <div class="p-15">
            <h5 class="card-title">Search Contact</h5>
            <form>
                <input class="form-control" type="text" placeholder="Search Contact" id="search-contact">
            </form>
        </div>
        <hr>
        <ul class="mailbox list-style-none" id="contact-list">
            <li>
                <div class="message-center chat-scroll">
                    @foreach ($users as $user)
                    <a href="javascript:void(0)" class="message-item" data-user-id="{{ $user->id }}"
                        onclick="loadChat({{ $user->id }})">
                        <span class="user-img">
                            <img src="{{ $user->profile_photo_url ?? 'https://via.placeholder.com/150' }}" alt="user"
                                class="rounded-circle">
                            <span class="profile-status online pull-right"></span>
                        </span>
                        <div class="mail-contnet">
                            <h5 class="message-title">{{ $user->name }}</h5>
                            <span class="mail-desc">
                                {{
                                            Str::limit(
                                                $getallMessages->filter(function ($message) use ($user) {
                                                    return $message->sender_id == $user->id || $message->receiver_id == $user->id;
                                                })->last()->message ?? 'No message yet', 30
                                            )
                                        }}
                            </span>
                            <span class="time">
                                {{
                                            $getallMessages->filter(function ($message) use ($user) {
                                                return $message->sender_id == $user->id || $message->receiver_id == $user->id;
                                            })->last()->created_at->diffForHumans()
                                        }}
                            </span>
                        </div>
                    </a>
                    @endforeach
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- Chat Area (Right) -->

<div class="right-part" id="right-part" style="display:none;">
    <div class="p-20">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Chat Messages</h4>
                <div class="chat-box scrollable" id="chat-box" style="height:calc(100vh - 300px);">
                    <ul class="chat-list" id="chat-list">
                        <li class="text-center text-muted">Select a user to start chatting</li>
                    </ul>
                </div>
            </div>
            <div class="card-body border-top">
                <div class="row">
                    <div class="col-9">
                        <input id="chat-input" placeholder="Type and enter" class="form-control border-0" type="text"
                            disabled>
                        <input type="hidden" id="current-user-id">
                    </div>
                    <div class="col-3">
                        <a class="btn-circle btn-lg btn-cyan float-right text-white" href="javascript:void(0)"
                            onclick="sendMessage()" id="send-button" disabled><i class="fas fa-paper-plane"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let currentUserId = null;
    let messageInterval = null;
    
    // Event listener global untuk tombol enter
    // Pastikan ini hanya dieksekusi sekali setelah halaman dimuat
document.addEventListener('DOMContentLoaded', function () {
    const chatInput = document.getElementById('chat-input');
    
    chatInput.addEventListener('keydown', function (event) {
        if (event.key === 'Enter' && !event.shiftKey) {
            event.preventDefault(); // Mencegah newline pada textarea
            sendMessage();
        }
    });
});

    
    // Fungsi untuk memulai chat
   // Fungsi untuk memulai chat
function loadChat(userId) {
    const rightPart = document.getElementById('right-part');
    const chatInput = document.getElementById('chat-input');
    const sendButton = document.getElementById('send-button');

    // Tampilkan area chat
    rightPart.style.display = 'block';
    document.getElementById('current-user-id').value = userId;
    currentUserId = userId;

    // Hentikan polling sebelumnya jika ada
    if (messageInterval) {
        clearInterval(messageInterval);
        messageInterval = null; // Pastikan interval benar-benar dihapus
    }

    // Kosongkan chat list sebelum memuat pesan baru
    const chatList = document.getElementById('chat-list');
    chatList.innerHTML = '';

    // Load pesan pertama kali
    loadMessages(userId);

    // Mulai polling setiap 3 detik
    messageInterval = setInterval(() => loadMessages(userId), 3000);

    // Aktifkan input dan tombol kirim
    chatInput.disabled = false;
    sendButton.disabled = false;
    scrollToBottom();
}

    
    // Fungsi untuk memuat pesan-pesan baru
  // Fungsi untuk memuat pesan-pesan baru
// Fungsi untuk memuat pesan-pesan baru
function loadMessages(userId) {
    const loadingIndicator = document.getElementById('loading-indicator');
    loadingIndicator.style.display = 'block';

    const lastMessageTime = document.getElementById('chat-list').lastElementChild?.dataset.timestamp || 0;

    fetch(`/dashboard/chat/messages/${userId}?last_message_time=${lastMessageTime}`)
        .then(response => response.json())
        .then(data => {
            const chatList = document.getElementById('chat-list');
            let lastSenderId = null;

            data.messages.forEach(message => {
                // Periksa apakah pesan ini sudah ada di chat list
                if (document.querySelector(`[data-timestamp="${message.created_at}"]`)) {
                    return;
                }

                const isAdmin = message.is_admin ? 'odd' : '';
                const senderProfileUrl = message.sender?.profile_photo_url || 'https://via.placeholder.com/150';

                if (message.sender_id === lastSenderId) {
                    // Gabungkan pesan jika pengirim sama
                    chatList.innerHTML += `
                        <li class="chat-item ${isAdmin}" data-timestamp="${message.created_at}">
                            <div class="chat-content">
                                <div class="box bg-light-info">${message.message}</div>
                            </div>
                            <div class="chat-time">${new Date(message.created_at).toLocaleTimeString()}</div>
                        </li>`;
                } else {
                    // Pisahkan pesan jika pengirim berbeda
                    chatList.innerHTML += `
                        <li class="chat-item ${isAdmin}" data-timestamp="${message.created_at}">
                            <div class="chat-img">
                                <img src="${senderProfileUrl}" alt="user">
                            </div>
                            <div class="chat-content">
                                <h6 class="font-medium">${message.sender?.name || 'Unknown User'}</h6>
                                <div class="box bg-light-info">${message.message}</div>
                            </div>
                            <div class="chat-time">${new Date(message.created_at).toLocaleTimeString()}</div>
                        </li>`;
                }

                lastSenderId = message.sender_id;
            });

            loadingIndicator.style.display = 'none';
            scrollToBottom();
        })
        .catch(error => {
            alert("Failed to load messages. Please try again.");
            loadingIndicator.style.display = 'none';
        });
}


    
    // Fungsi untuk scroll ke bawah otomatis setelah pesan baru dimuat
    function scrollToBottom() {
        const chatBox = document.getElementById('chat-box');
        chatBox.scrollTop = chatBox.scrollHeight;
    }
    
    
  // Fungsi untuk mengirim pesan
function sendMessage() {
    const input = document.getElementById('chat-input');
    const message = input.value.trim();
    const userId = document.getElementById('current-user-id').value;
    const sendButton = document.getElementById('send-button');

    // Cegah pengiriman pesan kosong
    if (!message || !userId) return;

    // Nonaktifkan tombol kirim sementara
    sendButton.disabled = true;

    fetch('/dashboard/chat/send', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({
            message: message,
            user_id: userId,
            receiver_id: userId
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const chatList = document.getElementById('chat-list');
            const currentTime = new Date().toLocaleTimeString();
            const isAdminMessage = data.message.is_admin ? 'odd' : '';

            const senderProfileUrl = data.message.sender?.profile_photo_url || 'https://via.placeholder.com/150';

            chatList.innerHTML += `
                <li class="chat-item ${isAdminMessage}" data-timestamp="${Date.now()}">
                    <div class="chat-img">
                        <img src="${senderProfileUrl}" alt="user">
                    </div>
                    <div class="chat-content">
                        <div class="box bg-light-inverse">${message}</div>
                    </div>
                    <div class="chat-time">${currentTime}</div>
                </li>`;

            scrollToBottom();
            input.value = ''; // Kosongkan input setelah kirim pesan
        }
    })
    .catch(error => {
        alert("Failed to send message. Please try again.");
    })
    .finally(() => {
        // Aktifkan kembali tombol kirim
        sendButton.disabled = false;
    });
}

</script>

@endsection
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Asistente Virtual - Sistema de Archivos</title>

    <style>
        #chat-widget {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 100px;
            height: 100px;
            background-color: rgb(4, 37, 39);
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;

            /* Animación flotante */
            animation: floatIcon 3s ease-in-out infinite;
        }

        #chat-widget img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            object-fit: cover;
            pointer-events: none; /* para que el clic pase al div */
        }

        @keyframes floatIcon {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        #chat-box {
            display: none;
            position: fixed;
            bottom: 120px; 
            right: 30px;
            width: 350px;
            max-height: 400px;
            background: white;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.2);
            z-index: 10000;
            display: flex;
            flex-direction: column;
        }

        #chat-header {
            padding: 10px;
            background: rgb(4, 39, 36);
            color: white;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
            user-select: none;
        }

        #chat-close {
            float: right;
            cursor: pointer;
        }

        #chat-content {
            padding: 10px;
            flex-grow: 1;
            overflow-y: auto;
            font-size: 14px;
        }

        #chat-input-container {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ccc;
        }

        #chat-input {
            flex-grow: 1;
            padding: 5px;
            font-size: 14px;
        }

        #chat-send {
            margin-left: 5px;
            padding: 5px 10px;
            background: rgb(6, 102, 131);
            color: white;
            border: none;
            cursor: pointer;
        }

        p.message {
            margin: 5px 0;
            padding: 8px 12px;
            border-radius: 15px;
            max-width: 75%;
            word-wrap: break-word;
        }

        p.message.user {
            background-color: rgb(4, 91, 102);
            color: white;
            align-self: flex-end;
        }

        p.message.bot {
            background-color: #f1f0f0;
            color: #333;
            align-self: flex-start;
        }
    </style>
</head>
<body>

<!-- Botón flotante con imagen -->
<div id="chat-widget">
    <img src="{{url('/dist/img/chat.png')}}" alt="Asistente" />
</div>

<!-- Chat box -->
<div id="chat-box">
    <div id="chat-header">
        ASISTENTE VIRTUAL SAI GAMV
        <span id="chat-close">✖</span>
    </div>
    <div id="chat-content"></div>
    <div id="chat-input-container">
        <input type="text" id="chat-input" placeholder="Escribe tu mensaje..." autocomplete="off" />
        <button id="chat-send">Enviar</button>
    </div>
</div>

<script>
    const chatWidget = document.getElementById('chat-widget');
    const chatBox = document.getElementById('chat-box');
    const chatClose = document.getElementById('chat-close');
    const chatContent = document.getElementById('chat-content');
    const chatInput = document.getElementById('chat-input');
    const chatSend = document.getElementById('chat-send');

    const assistantMessageUrl = "{{ url('/assistant/message') }}";

    chatWidget.addEventListener('click', () => {
        chatBox.style.display = chatBox.style.display === 'flex' ? 'none' : 'flex';
        if (chatBox.style.display === 'flex') {
            chatInput.focus();
        }
    });

    chatClose.addEventListener('click', () => {
        chatBox.style.display = 'none';
    });

    function addMessage(text, sender) {
        const p = document.createElement('p');
        p.classList.add('message');
        p.classList.add(sender === 'user' ? 'user' : 'bot');
        p.textContent = sender === 'user' ? 'Tú: ' + text : 'Asistente: ' + text;
        chatContent.appendChild(p);
        chatContent.scrollTop = chatContent.scrollHeight;
    }

    function sendMessage() {
        const message = chatInput.value.trim();
        if (!message) return;

        addMessage(message, 'user');
        chatInput.value = '';
        chatInput.disabled = true;
        chatSend.disabled = true;

        fetch(assistantMessageUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ message: message })
        })
        .then(res => {
            if (!res.ok) throw new Error('Error en la respuesta del servidor');
            return res.json();
        })
        .then(data => {
            addMessage(data.reply, 'bot');
        })
        .catch(() => {
            addMessage('Error al procesar el mensaje.', 'bot');
        })
        .finally(() => {
            chatInput.disabled = false;
            chatSend.disabled = false;
            chatInput.focus();
        });
    }

    chatSend.addEventListener('click', sendMessage);

    chatInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });
</script>

</body>
</html>

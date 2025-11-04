<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Asistente Virtual - Sistema de Archivos</title>

    <style>
        /* === BOTÓN FLOTANTE === */
        #chat-widget {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 90px;
            height: 90px;
            background-color: rgb(4, 37, 39);
            border-radius: 50%;
            box-shadow: 0 2px 10px rgba(0,0,0,0.3);
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 9999;
            animation: floatIcon 3s ease-in-out infinite;
        }

        #chat-widget img {
            width: 65px;
            height: 65px;
            border-radius: 50%;
            object-fit: cover;
            pointer-events: none;
        }

        @keyframes floatIcon {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-8px); }
        }

        /* === CAJA DEL CHAT === */
        #chat-box {
            display: none;
            position: fixed;
            bottom: 130px;
            right: 30px;
            width: 420px;
            height: 520px;
            background: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.3);
            z-index: 10000;
            flex-direction: column;
            overflow: hidden;
            opacity: 0;
            transform: scale(0.9);
        }

        #chat-header {
            padding: 12px 16px;
            background: rgb(4, 39, 36);
            color: white;
            font-weight: bold;
            user-select: none;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        #chat-close {
            cursor: pointer;
            font-size: 18px;
        }

        #chat-content {
            flex-grow: 1;
            padding: 14px;
            overflow-y: auto;
            font-size: 14px;
            background-color: #f8fafc;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        /* === BURBUJAS DE MENSAJE === */
        .message {
            margin: 0;
            padding: 10px 14px;
            border-radius: 16px;
            max-width: 80%;
            word-wrap: break-word;
            display: inline-block;
            line-height: 1.4;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }

        .message.user {
            background-color: rgb(4, 91, 102);
            color: white;
            align-self: flex-end;
            border-radius: 16px 16px 4px 16px;
        }

        .message.bot {
            background-color: #e5e7eb;
            color: #111827;
            align-self: flex-start;
            border-radius: 16px 16px 16px 4px;
        }

        /* === INDICADOR DE ESCRIBIENDO === */
        .typing {
            align-self: flex-start;
            display: flex;
            gap: 5px;
            padding: 0 10px;
        }

        .dot {
            width: 8px;
            height: 8px;
            background-color: #999;
            border-radius: 50%;
            animation: blink 1.4s infinite;
        }

        .dot:nth-child(2) { animation-delay: 0.2s; }
        .dot:nth-child(3) { animation-delay: 0.4s; }

        @keyframes blink {
            0%, 80%, 100% { opacity: 0.3; }
            40% { opacity: 1; }
        }

        /* === INPUT === */
        #chat-input-container {
            display: flex;
            padding: 10px;
            border-top: 1px solid #ddd;
            background-color: #fff;
        }

        #chat-input {
            flex-grow: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 6px;
            font-size: 14px;
        }

        #chat-send {
            margin-left: 8px;
            padding: 8px 14px;
            background: rgb(6, 102, 131);
            color: white;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 500;
        }

        #chat-send:hover {
            background: rgb(3, 78, 95);
        }
    </style>
</head>
<body>

<!-- BOTÓN FLOTANTE -->
<div id="chat-widget">
    <img src="{{ url('/dist/img/chat.png') }}" alt="Asistente" />
</div>

<!-- CAJA DEL CHAT -->
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

    // Inicialmente oculto
    window.addEventListener('DOMContentLoaded', () => {
        chatBox.style.display = 'none';
        chatBox.style.opacity = 0;
        chatBox.style.transform = 'scale(0.9)';
    });

    // Abrir chat con animación
    function openChat() {
        chatBox.style.display = 'flex';
        setTimeout(() => {
            chatBox.style.transition = 'opacity 0.3s ease, transform 0.3s ease';
            chatBox.style.opacity = 1;
            chatBox.style.transform = 'scale(1)';
        }, 10);
        chatInput.focus();
    }

    // Cerrar chat con animación
    function closeChat() {
        chatBox.style.transition = 'opacity 0.2s ease, transform 0.2s ease';
        chatBox.style.opacity = 0;
        chatBox.style.transform = 'scale(0.9)';
        setTimeout(() => {
            chatBox.style.display = 'none';
        }, 200);
    }

    // Alternar al hacer clic en el botón
    chatWidget.addEventListener('click', () => {
        if (chatBox.style.display === 'flex') {
            closeChat();
        } else {
            openChat();
        }
    });

    chatClose.addEventListener('click', closeChat);

    // Función para agregar mensajes
    function addMessage(text, sender) {
        const p = document.createElement('p');
        p.classList.add('message', sender);
        p.textContent = (sender === 'user' ? 'Tú: ' : 'Asistente: ') + text;
        chatContent.appendChild(p);
        chatContent.scrollTop = chatContent.scrollHeight;
    }

    // Indicador de escribiendo
    function showTyping() {
        const typingDiv = document.createElement('div');
        typingDiv.classList.add('typing');
        typingDiv.innerHTML = '<div class="dot"></div><div class="dot"></div><div class="dot"></div>';
        chatContent.appendChild(typingDiv);
        chatContent.scrollTop = chatContent.scrollHeight;
        return typingDiv;
    }

    // Enviar mensaje
    function sendMessage() {
        const message = chatInput.value.trim();
        if (!message) return;

        addMessage(message, 'user');
        chatInput.value = '';
        chatInput.disabled = true;
        chatSend.disabled = true;

        const typingDiv = showTyping();

        fetch(assistantMessageUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ message })
        })
        .then(res => res.json())
        .then(data => {
            chatContent.removeChild(typingDiv);
            addMessage(data.reply || 'Lo siento, no pude procesar tu solicitud.', 'bot');
        })
        .catch(() => {
            chatContent.removeChild(typingDiv);
            addMessage('Error al procesar el mensaje.', 'bot');
        })
        .finally(() => {
            chatInput.disabled = false;
            chatSend.disabled = false;
            chatInput.focus();
        });
    }

    chatSend.addEventListener('click', sendMessage);
    chatInput.addEventListener('keypress', e => {
        if (e.key === 'Enter') {
            e.preventDefault();
            sendMessage();
        }
    });
</script>

</body>
</html>

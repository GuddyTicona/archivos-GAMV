<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asistente Virtual SAI GAMV</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <style>
      body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        background-color: #f4f6f8;
      }

      /* Botón flotante */
      .floating-container {
        width: 70px;
        height: 70px;
        border-radius: 50%;
        background-color: #004d40;
        position: fixed;
        bottom: 20px;
        right: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        z-index: 1000;
      }

      .floating-container img {
        width: 80%;
        height: 80%;
        border-radius: 50%;
      }

      /* Contenedor del chat */
      .chat-container {
        position: fixed;
        bottom: 100px;
        right: 20px;
        width: 420px; /* 🔹 Aumentado el ancho */
        height: 520px;
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        z-index: 999;
        animation: fadeIn 0.3s ease-in-out;
      }

      @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.9); }
        to { opacity: 1; transform: scale(1); }
      }

      .chat-header {
        background-color: #004d40;
        color: white;
        padding: 10px 15px;
        font-weight: bold;
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .chat-body {
        flex: 1;
        padding: 15px;
        overflow-y: auto;
        background-color: #f8fafc;
        display: flex;
        flex-direction: column;
        gap: 10px;
      }

      .message-wrapper {
        display: flex;
        flex-direction: column;
        width: 100%;
        animation: slideIn 0.3s ease;
      }

      @keyframes slideIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
      }

      .sender-label {
        font-size: 12px;
        font-weight: 600;
        margin-bottom: 3px;
      }

      .sender-label.user {
        color: #004d40;
        text-align: right;
        margin-right: 8px;
      }

      .sender-label.assistant {
        color: #555;
        text-align: left;
        margin-left: 8px;
      }

      .message.user {
        align-self: flex-end;
        background-color: #004d40;
        color: white;
        border-radius: 16px 16px 4px 16px;
        max-width: 80%;
        padding: 10px 14px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        word-wrap: break-word;
      }

      .message.assistant {
        align-self: flex-start;
        background-color: #e5e7eb;
        color: #111827;
        border-radius: 16px 16px 16px 4px;
        max-width: 80%;
        padding: 10px 14px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        word-wrap: break-word;
      }

      .chat-input-container {
        display: flex;
        padding: 10px;
        border-top: 1px solid #e0e0e0;
        background-color: #fff;
      }

      .chat-input {
        flex: 1;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
      }

      .chat-send-button {
        margin-left: 8px;
        background-color: #004d40;
        color: #fff;
        border: none;
        border-radius: 4px;
        padding: 8px 14px;
        cursor: pointer;
        transition: background-color 0.3s;
      }

      .chat-send-button:hover {
        background-color: #00695c;
      }

      .close-button {
        background: transparent;
        color: white;
        border: none;
        font-size: 18px;
        cursor: pointer;
      }

      /* Indicador de escribiendo */
      .typing-indicator {
        align-self: flex-start;
        display: flex;
        gap: 4px;
        margin: 8px 12px;
      }

      .dot {
        width: 8px;
        height: 8px;
        background-color: #aaa;
        border-radius: 50%;
        animation: blink 1.4s infinite;
      }

      .dot:nth-child(2) {
        animation-delay: 0.2s;
      }

      .dot:nth-child(3) {
        animation-delay: 0.4s;
      }

      @keyframes blink {
        0%, 80%, 100% { opacity: 0.3; }
        40% { opacity: 1; }
      }

    </style>
</head>

<body>
<div id="chatApp">
  <!-- Botón flotante -->
  <div v-if="!chatOpen" class="floating-container" @click="toggleChat">
    <img src="{{ asset('storage/images/sai.png') }}" alt="Asistente Virtual">
  </div>

  <!-- Ventana de chat -->
  <div v-if="chatOpen" class="chat-container">
    <div class="chat-header">
      <span>ASISTENTE VIRTUAL SAI GAMV</span>
      <button class="close-button" @click="toggleChat">×</button>
    </div>

    <div class="chat-body" ref="chatBody">
      <div v-for="(msg, index) in messages" :key="index" class="message-wrapper">
        <div :class="['sender-label', msg.sender]">@{{ msg.sender === 'user' ? 'Tú:' : 'Asistente:' }}</div>
        <div :class="['message', msg.sender]">@{{ msg.text }}</div>
      </div>

      <!-- Indicador de escribiendo -->
      <div v-if="isTyping" class="typing-indicator">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
      </div>
    </div>

    <div class="chat-input-container">
      <input v-model="inputMessage" class="chat-input" placeholder="Escribe tu mensaje..." @keyup.enter="sendMessage">
      <button class="chat-send-button" @click="sendMessage">Enviar</button>
    </div>
  </div>
</div>

<script>
  new Vue({
    el: '#chatApp',
    data: {
      chatOpen: false,
      inputMessage: '',
      messages: [],
      isTyping: false, // 🔹 indicador de escribiendo
    },
    methods: {
      toggleChat() {
        this.chatOpen = !this.chatOpen;
      },
      sendMessage() {
        const text = this.inputMessage.trim();
        if (!text) return;

        this.messages.push({ text: text, sender: 'user' });
        this.inputMessage = '';
        this.scrollToBottom();

        this.isTyping = true;

        axios.post('/sai', { message: text })
          .then(res => {
            setTimeout(() => {
              const reply = res.data.reply || 'Lo siento, no pude procesar tu solicitud.';
              this.messages.push({ text: reply, sender: 'assistant' });
              this.isTyping = false;
              this.scrollToBottom();
            }, 1000);
          })
          .catch(() => {
            this.isTyping = false;
            this.messages.push({ text: 'Error al conectar con el servidor.', sender: 'assistant' });
          });
      },
      scrollToBottom() {
        this.$nextTick(() => {
          const chatBody = this.$refs.chatBody;
          chatBody.scrollTop = chatBody.scrollHeight;
        });
      }
    }
  });
</script>
</body>
</html>

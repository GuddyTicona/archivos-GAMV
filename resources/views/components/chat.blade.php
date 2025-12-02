<link href="https://cdn.jsdelivr.net/npm/@n8n/chat/dist/style.css" rel="stylesheet" />
<script type="module">
  import { createChat } from 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/chat.bundle.es.js';

  createChat({
    webhookUrl: 'https://guddy.app.n8n.cloud/webhook/f80a9071-c34a-4c4d-8ad5-73d183f7a2a5/chat',
    webhookConfig: {
      method: 'POST',
      headers: {}
    },
    target: '#n8n-chat',
    mode: 'window',
    chatInputKey: 'chatInput',
    chatSessionKey: 'sessionId',
    loadPreviousSession: true,
    metadata: {},
    showWelcomeScreen: false,
    defaultLanguage: 'es',
    initialMessages: [
      '¡Hola! 👋',
      'Soy el Asistente Virtual GAMV. ¿En que puedo ayudarte?'
    ],
    i18n: {
      es: {
        title: '¡Hola! 👋',
        subtitle: 'Inicia una conversación. Estamos aquí para ayudarte 24/7.',
        footer: '',
        getStarted: 'Nueva Conversación',
        inputPlaceholder: 'Escribe tu pregunta...',
        closeButtonTooltip: 'Cerrar chat',
        sendButtonText: 'Enviar',
        newConversationText: 'Nueva Conversación',
        error: 'Ocurrió un error. Por favor, intenta de nuevo.',
      },
    },
    enableStreaming: false,
  });
</script>
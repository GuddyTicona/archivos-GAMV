<link href="https://cdn.jsdelivr.net/npm/@n8n/chat/dist/style.css" rel="stylesheet" />
<script type="module">
  import { createChat } from 'https://cdn.jsdelivr.net/npm/@n8n/chat/dist/chat.bundle.es.js';

  createChat({
    webhookUrl: 'https://guddyth.app.n8n.cloud/webhook/682292ab-5b6e-40ce-99f7-8bca3fa8e55b/chat',
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
        title: 'Bienvenido/a Asistente GAMV',
        subtitle: 'Inicia una conversación, Estamos aqui para guiarte en la utilidad del sistema',
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
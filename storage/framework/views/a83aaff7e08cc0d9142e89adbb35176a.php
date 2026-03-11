<link href="https://cdn.jsdelivr.net/npm/@n8n/chat@latest/dist/style.css" rel="stylesheet" />
<script type="module">
  import { createChat } from 'https://cdn.jsdelivr.net/npm/@n8n/chat@latest/dist/chat.bundle.es.js';
  createChat({
    webhookUrl: 'http://localhost:5678/webhook/520c5e84-8a84-4227-b1d6-b343ee666d1c/chat',
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
</script><?php /**PATH C:\xampp\htdocs\sisarchivo\resources\views/components/chat.blade.php ENDPATH**/ ?>
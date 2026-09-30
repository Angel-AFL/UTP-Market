document.addEventListener('DOMContentLoaded', function() {
    const chatbotToggle = document.getElementById('chatbot-toggle');
    const chatbotWindow = document.getElementById('chatbot-window');
    const chatbotClose = document.getElementById('chatbot-close');
    const chatbotMessages = document.getElementById('chatbot-messages');
    const chatbotInput = document.getElementById('chatbot-input');
    const chatbotSend = document.getElementById('chatbot-send');
    const typingIndicator = document.getElementById('typing-indicator');

    // Manejar apertura y cierre
    chatbotToggle.addEventListener('click', () => {
        chatbotWindow.classList.toggle('open');
        if (chatbotWindow.classList.contains('open')) {
            chatbotInput.focus();
        }
    });

    chatbotClose.addEventListener('click', () => {
        chatbotWindow.classList.remove('open');
    });

    // Enviar mensaje al presionar Enter
    chatbotInput.addEventListener('keypress', (e) => {
        if (e.key === 'Enter') {
            sendMessage();
        }
    });

    // Enviar mensaje al hacer clic en el botón
    chatbotSend.addEventListener('click', () => {
        sendMessage();
    });

    function sendMessage() {
        const text = chatbotInput.value.trim();
        if (text === '') return;

        // Añadir mensaje del usuario a la interfaz
        addMessage(text, 'user');
        chatbotInput.value = '';

        // Mostrar indicador de "Escribiendo..."
        typingIndicator.style.display = 'block';
        scrollToBottom();

        // Limpiar el HTML para evitar XSS
        const safeText = text.replace(/</g, "&lt;").replace(/>/g, "&gt;");

        // Enviar a la API
        fetch('/api/chatbot.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ message: safeText })
        })
        .then(response => response.json())
        .then(data => {
            typingIndicator.style.display = 'none';
            if (data.error) {
                addMessage('Lo siento, hubo un error de conexión con la IA.', 'bot');
            } else if (data.response) {
                addMessage(formatText(data.response), 'bot', true);
            } else {
                addMessage('Lo siento, no pude entender eso.', 'bot');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            typingIndicator.style.display = 'none';
            addMessage('Error de red. Inténtalo de nuevo más tarde.', 'bot');
        });
    }

    function addMessage(text, sender, isHtml = false) {
        const msgDiv = document.createElement('div');
        msgDiv.classList.add('chat-message', sender);
        if (isHtml) {
            msgDiv.innerHTML = text;
        } else {
            msgDiv.textContent = text;
        }
        
        // Insertar el mensaje antes del indicador de escritura
        chatbotMessages.insertBefore(msgDiv, typingIndicator);
        scrollToBottom();
    }

    function scrollToBottom() {
        chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
    }

    function formatText(text) {
        // Formateo muy básico de Markdown a HTML (Negritas y saltos de línea)
        let formatted = text.replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>');
        formatted = formatted.replace(/\*(.*?)\*/g, '<em>$1</em>');
        formatted = formatted.replace(/\n/g, '<br>');
        return formatted;
    }
});

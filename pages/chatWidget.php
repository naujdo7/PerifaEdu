<!-- CHAT WIDGET - PerifaEdu -->
<div id="chat-fab" onclick="toggleChat()" title="Ajuda">
    <svg id="chat-icon-open" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/></svg>
    <svg id="chat-icon-close" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" style="display:none"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
    <span id="chat-badge" style="display:none"></span>
</div>

<div id="chat-panel">
    <div id="chat-panel-header">
        <div id="chat-header-info">
            <div id="chat-avatar">
                <img src="/PerifaEdu/PerifaEdu/img/perifaedu-logo.png" alt="PerifaEdu" style="width:100%; height:100%; object-fit:cover; border-radius:50%;">
            </div>
            <div>
                <p id="chat-header-name">PerifaEdu</p>
                <p id="chat-header-status"><span class="status-dot"></span>Online</p>
            </div>
        </div>
        <button id="chat-close-btn" onclick="toggleChat()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
        </button>
    </div>

    <div id="chat-messages">
        <div class="msg-row bot-row">
            <div class="msg-bubble bot-bubble">
                Olá! 👋 Sou o assistente da PerifaEdu. Como posso te ajudar hoje?
            </div>
        </div>
        <div id="chat-suggestions">
            <button class="suggestion-chip" onclick="sendSuggestion('Como faço login?')">Como faço login?</button>
            <button class="suggestion-chip" onclick="sendSuggestion('Esqueci minha senha')">Esqueci minha senha</button>
            <button class="suggestion-chip" onclick="sendSuggestion('Como modificar minha foto?')">Modificar foto</button>
        </div>
    </div>

    <div id="chat-input-row">
        <input id="chat-input" type="text" placeholder="Digite sua dúvida..." autocomplete="off" onkeydown="if(event.key==='Enter')enviar()">
        <button id="chat-send-btn" onclick="enviar()">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"/><polygon points="22 2 15 22 11 13 2 9 22 2"/></svg>
        </button>
    </div>
</div>

<style>
#chat-fab {
    position: fixed;
    bottom: 28px;
    right: 28px;
    width: 52px;
    height: 52px;
    border-radius: 50%;
    background: #0357a5;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    z-index: 9999;
    box-shadow: 0 4px 16px rgba(26,107,69,0.35);
    transition: transform 0.2s, background 0.2s;
}
#chat-fab:hover { background: #0357a5; transform: scale(1.07); }
#chat-badge {
    position: absolute;
    top: 6px; right: 6px;
    width: 10px; height: 10px;
    background: #e05c2d;
    border-radius: 50%;
    border: 2px solid #fff;
}

#chat-panel {
    position: fixed;
    bottom: 92px;
    right: 28px;
    width: 340px;
    max-height: 520px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.13), 0 1.5px 4px rgba(0,0,0,0.07);
    display: none;
    flex-direction: column;
    z-index: 9998;
    overflow: hidden;
    font-family: 'Segoe UI', system-ui, sans-serif;
    animation: chatSlideIn 0.22s cubic-bezier(.34,1.4,.64,1) forwards;
}
@keyframes chatSlideIn {
    from { opacity: 0; transform: translateY(16px) scale(0.97); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}

#chat-panel-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 14px 16px;
    background: #0357a5;
    color: #fff;
}
#chat-header-info { display: flex; align-items: center; gap: 10px; }
#chat-avatar {
    width: 34px; height: 34px;
    border-radius: 50%;
    background: rgba(255,255,255,0.2);
    display: flex; align-items: center; justify-content: center;
}
#chat-header-name { margin: 0; font-size: 14px; font-weight: 600; }
#chat-header-status { margin: 0; font-size: 11px; opacity: 0.85; display: flex; align-items: center; gap: 4px; }
.status-dot {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: #7ef0b0;
    display: inline-block;
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.5; }
}
#chat-close-btn {
    background: none; border: none; color: rgba(255,255,255,0.8);
    cursor: pointer; padding: 4px; border-radius: 6px;
    display: flex; align-items: center;
    transition: background 0.15s, color 0.15s;
}
#chat-close-btn:hover { background: rgba(255,255,255,0.15); color: #fff; }

#chat-messages {
    flex: 1;
    overflow-y: auto;
    padding: 14px 14px 6px;
    display: flex;
    flex-direction: column;
    gap: 8px;
    scroll-behavior: smooth;
}
#chat-messages::-webkit-scrollbar { width: 4px; }
#chat-messages::-webkit-scrollbar-thumb { background: #d1d5db; border-radius: 4px; }

.msg-row { display: flex; }
.bot-row { justify-content: flex-start; }
.user-row { justify-content: flex-end; }

.msg-bubble {
    max-width: 82%;
    padding: 9px 13px;
    border-radius: 14px;
    font-size: 13.5px;
    line-height: 1.5;
}
.bot-bubble {
    background: #f0f4f2;
    color: #1a2b23;
    border-bottom-left-radius: 4px;
}
.user-bubble {
    background: #0357a5;
    color: #fff;
    border-bottom-right-radius: 4px;
}

.typing-bubble {
    background: #f0f4f2;
    padding: 10px 16px;
    border-radius: 14px;
    border-bottom-left-radius: 4px;
    display: flex; gap: 5px; align-items: center;
}
.typing-bubble span {
    width: 7px; height: 7px;
    border-radius: 50%;
    background: #9ca3af;
    animation: typing 1.2s infinite;
}
.typing-bubble span:nth-child(2) { animation-delay: 0.2s; }
.typing-bubble span:nth-child(3) { animation-delay: 0.4s; }
@keyframes typing {
    0%, 60%, 100% { transform: translateY(0); }
    30% { transform: translateY(-5px); }
}

#chat-suggestions {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 4px;
}
.suggestion-chip {
    background: #fff;
    border: 1px solid #c6ddd3;
    color: #0357a5;
    border-radius: 20px;
    padding: 5px 12px;
    font-size: 12px;
    cursor: pointer;
    font-family: inherit;
    transition: background 0.15s, border-color 0.15s;
}
.suggestion-chip:hover { background: #eaf4ee; border-color: #0357a5; }

#chat-input-row {
    display: flex;
    align-items: center;
    gap: 8px;
    padding: 10px 12px;
    border-top: 1px solid #eee;
    background: #fff;
}
#chat-input {
    flex: 1;
    border: 1.5px solid #e5e7eb;
    border-radius: 22px;
    padding: 8px 14px;
    font-size: 13.5px;
    font-family: inherit;
    outline: none;
    transition: border-color 0.2s;
    color: #111;
    background: #f9fafb;
}
#chat-input:focus { border-color: #0357a5; background: #fff; }
#chat-send-btn {
    width: 36px; height: 36px;
    border-radius: 50%;
    background: #0357a5;
    color: #fff;
    border: none;
    cursor: pointer;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0;
    transition: background 0.15s, transform 0.15s;
}
#chat-send-btn:hover { background: #0357a5; transform: scale(1.06); }
#chat-send-btn:disabled { background: #a7c4b5; cursor: not-allowed; transform: none; }

@media (max-width: 420px) {
    #chat-panel { width: calc(100vw - 24px); right: 12px; bottom: 80px; }
    #chat-fab { right: 16px; bottom: 20px; }
}
</style>

<script>
(function() {
    let isOpen = false;

    window.toggleChat = function() {
        isOpen = !isOpen;
        const panel = document.getElementById('chat-panel');
        const iconOpen = document.getElementById('chat-icon-open');
        const iconClose = document.getElementById('chat-icon-close');
        const badge = document.getElementById('chat-badge');

        if (isOpen) {
            panel.style.display = 'flex';
            iconOpen.style.display = 'none';
            iconClose.style.display = 'block';
            badge.style.display = 'none';
            setTimeout(() => document.getElementById('chat-input').focus(), 200);
        } else {
            panel.style.animation = 'none';
            panel.style.display = 'none';
            panel.style.animation = '';
            iconOpen.style.display = 'block';
            iconClose.style.display = 'none';
        }
    };

    window.sendSuggestion = function(text) {
        document.getElementById('chat-suggestions').style.display = 'none';
        document.getElementById('chat-input').value = text;
        enviar();
    };

    window.enviar = function() {
        const input = document.getElementById('chat-input');
        const msg = input.value.trim();
        if (!msg) return;

        input.value = '';
        document.getElementById('chat-send-btn').disabled = true;

        appendMessage(msg, 'user');
        showTyping();

        fetch('/PerifaEdu/PerifaEdu/pages/chat.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'msg=' + encodeURIComponent(msg)
        })
        .then(r => r.text())
        .then(resp => {
            hideTyping();
            appendMessage(resp, 'bot');
            document.getElementById('chat-send-btn').disabled = false;
            input.focus();
        })
        .catch(() => {
            hideTyping();
            appendMessage('Ops, tive um problema. Tente novamente em instantes.', 'bot');
            document.getElementById('chat-send-btn').disabled = false;
        });
    };

    function appendMessage(text, from) {
        const box = document.getElementById('chat-messages');
        const row = document.createElement('div');
        row.className = 'msg-row ' + (from === 'bot' ? 'bot-row' : 'user-row');
        const bubble = document.createElement('div');
        bubble.className = 'msg-bubble ' + (from === 'bot' ? 'bot-bubble' : 'user-bubble');
        bubble.textContent = text;
        row.appendChild(bubble);
        box.appendChild(row);
        box.scrollTop = box.scrollHeight;
    }

    let typingEl = null;
    function showTyping() {
        const box = document.getElementById('chat-messages');
        const row = document.createElement('div');
        row.className = 'msg-row bot-row';
        row.id = 'typing-indicator';
        const bubble = document.createElement('div');
        bubble.className = 'typing-bubble';
        bubble.innerHTML = '<span></span><span></span><span></span>';
        row.appendChild(bubble);
        box.appendChild(row);
        box.scrollTop = box.scrollHeight;
        typingEl = row;
    }

    function hideTyping() {
        if (typingEl) { typingEl.remove(); typingEl = null; }
    }
})();
</script>
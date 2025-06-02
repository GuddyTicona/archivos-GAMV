document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById("chat-toggle");
    const box = document.getElementById("chat-box");
    const input = document.getElementById("user-input");
    const messages = document.getElementById("chat-messages");

    toggle.addEventListener("click", () => {
        box.classList.toggle("hidden");
    });

    input.addEventListener("keydown", async (e) => {
        if (e.key === "Enter" && input.value.trim() !== "") {
            const text = input.value.trim();
            appendMessage(text, "right");
            input.value = "";

            const response = await fetch("/chat", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ message: text })
            });

            const data = await response.json();
            appendMessage(data.reply, "left");
        }
    });

    function appendMessage(text, align = "left") {
        const div = document.createElement("div");
        div.className = `text-${align} mb-2`;
        div.textContent = text;
        messages.appendChild(div);
        messages.scrollTop = messages.scrollHeight;
    }
});

<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>چت‌بات تلگرامی</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-900 font-roboto text-white">
    <div class="container mx-auto max-w-md h-screen flex flex-col bg-gray-800 shadow-2xl">
        <!-- هدر -->
        <div class="bg-gray-900 p-4 flex items-center border-b border-gray-700">
            <div class="w-10 h-10 rounded-full bg-blue-600 flex items-center justify-center">
                <i class="fas fa-robot text-lg"></i>
            </div>
            <div class="mr-3">
                <h1 class="text-lg font-bold">چت‌بات تلگرامی</h1>
                <span id="status" class="text-xs text-gray-400">آنلاین</span>
            </div>
        </div>

        <!-- باکس چت -->
        <div id="chat-box" class="flex-1 p-4 overflow-y-auto bg-gray-800" style="background-image: url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMTAwJSIgaGVpZ2h0PSIxMDAlIiB2aWV3Qm94PSIwIDAgMTAwIDEwMCIgZmlsbD0ibm9uZSIgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIj48cGF0aCBkPSJNMC41IDEuNUMxLjUgMC41IDMuNSAwLjUgNS41IDEuNUM2LjUgMi41IDYuNSA0LjUgNS41IDUuNUM0LjUgNi41IDIuNSA2LjUgMS41IDUuNUMwLjUgNC41IDAuNSAyLjUgMS41IDEuNVoiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48cGF0aCBkPSJNMTcuNSAxLjVDMTguNSAwLjUgMjAuNSAwLjUgMjIuNSAxLjVDMjMuNSAyLjUgMjMuNSA0LjUgMjIuNSAxMC41QzIxLjUgMTEuNSAxOS41IDExLjUgMTguNSAxMC41QzE3LjUgOS41IDE3LjUgNy41IDE4LjUgMS41WiIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjxwYXRoIGQ9Ik0zNC41IDEuNUMzNS41IDAuNSAzNy41IDAuNSAzOS41IDEuNUM0MC41IDIuNSA0MC41IDQuNSA0My41IDEwLjVDNDIuNSAxMS41IDQwLjUgMTEuNSAzOS41IDEwLjVDMzguNSA5LjUgMzguNSA3LjUgMzkuNSAxLjVaIiBmaWxsPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDUpIi8+PHBhdGggZD0iTTY4LjUgMS41QzY5LjUgMC41IDcxLjUgMC41IDczLjUgMS41Qzc0LjUgMi41IDc0LjUgNC41IDczLjUgNS41QzcyLjUgNi41IDcwLjUgNi41IDY5LjUgNS41QzY4LjUgNC41IDY4LjUgMi41IDY5LjUgMS41WiIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjxwYXRoIGQ9Ik0xLjUgMTguNUMyLjUgMTcuNSA0LjUgMTcuNSA2LjUgMTguNUM3LjUgMTkuNSA3LjUgMjEuNSA2LjUgMjIuNUM1LjUgMjMuNSAzLjUgMjMuNSAyLjUgMjIuNUMxLjUgMjEuNSAxLjUgMTkuNSAyLjUgMTguNVoiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48cGF0aCBkPSJNMTguNSAxOC41QzE5LjUgMTcuNSAyMS41IDE3LjUgMjMuNSAxOC41QzI0LjUgMTkuNSAyNC41IDIxLjUgMjMuNSAyMi41QzIyLjUgMjMuNSAyMC41IDIzLjUgMTkuNSAyMi41QzE4LjUgMjEuNSAxOC41IDE5LjUgMTkuNSAxOC41WiIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjxwYXRoIGQ9Ik0zNS41IDE4LjVDMzYuNSAxNy41IDM4LjUgMTcuNSA0MC41IDE4LjVDNDEuNSAxOS41IDQxLjUgMjEuNSA0MC41IDIyLjVDMzkuNSAyMy41IDM3LjUgMjMuNSAzNi41IDIyLjVDMzUuNSAyMS41IDM1LjUgMTkuNSAzNi41IDE4LjVaIiBmaWxsPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDUpIi8+PHBhdGggZD0iTTY5LjUgMTguNUM3MC41IDE3LjUgNzIuNSAxNy41IDc0LjUgMTguNUM3NS41IDE5LjUgNzUuNSAyMS41IDc0LjUgMjIuNUM3My41IDIzLjUgNzEuNSAyMy41IDcwLjUgMjIuNUM2OS41IDIxLjUgNjkuNSAxOS41IDcwLjUgMTguNVoiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48cGF0aCBkPSJNMS41IDM1LjVDMi41IDM0LjUgNC41IDM0LjUgNi41IDM1LjVDNy41IDM2LjUgNy41IDM4LjUgNi41IDM5LjVDNS41IDQwLjUgMy41IDQwLjUgMi41IDM5LjVDMS41IDM4LjUgMS41IDM2LjUgMi41IDM1LjVaIiBmaWxsPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDUpIi8+PHBhdGggZD0iTTE4LjUgMzUuNUMxOS41IDM0LjUgMjEuNSAzNC41IDIzLjUgMzUuNUMyNC41IDM2LjUgMjQuNSAzOC41IDIzLjUgMzkuNUMyMi41IDQwLjUgMjAuNSA0MC41IDE5LjUgMzkuNUMxOC41IDM4LjUgMTguNSAzNi41IDE5LjUgMzUuNVoiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48cGF0aCBkPSJNMzUuNSAzNS41QzM2LjUgMzQuNSA0OC41IDM0LjUgNTAuNSAzNS41QzUxLjUgMzYuNSA1MS41IDM4LjUgNTAuNSAzOS41QzQ5LjUgNDAuNSA0Ny41IDQwLjUgMzYuNSAzOS41QzM1LjUgMzguNSAzNS41IDM2LjUgMzYuNSAzNS41WiIgZmlsbD0icmdiYSgyNTUsMjU1LDI1NSwwLjA1KSIvPjxwYXRoIGQ9Ik02OS41IDM1LjVDNzAuNSAzNC41IDcyLjUgMzQuNSA3NC41IDM1LjVDNzUuNSAzNi41IDc1LjUgMzguNSA3NC41IDM5LjVDNzMuNSA0MC41IDcxLjUgNDAuNSA3MC41IDM5LjVDNjkuNSAzOC41IDY5LjUgMzYuNSA3MC41IDM1LjVaIiBmaWxsPSJyZ2JhKDI1NSwyNTUsMjU1LDAuMDUpIi8+PHBhdGggZD0iTTY5LjUgNjkuNUM3MC41IDY4LjUgNzIuNSA2OC41IDc0LjUgNjkuNUM3NS41IDcwLjUgNzUuNSA3Mi41IDc0LjUgNzMuNUM3My41IDc0LjUgNzEuNSA3NC41IDcwLjUgNzMuNUM2OS41IDcyLjUgNjkuNSA3MC41IDcwLjUgNjkuNVoiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4='); background-size: 100px 100px;">
            <!-- پیام‌ها اینجا اضافه می‌شوند -->
        </div>

        <!-- ورودی پیام -->
        <div class="p-4 bg-gray-800 border-t border-gray-700">
            <div class="flex items-center">
                <input type="text" id="user-message" class="flex-1 p-3 rounded-full bg-gray-700 border border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 text-white placeholder-gray-400" placeholder="پیام خود را بنویسید..." onkeypress="if(event.key === 'Enter') sendMessage()">
                <button onclick="sendMessage()" class="mr-2 bg-blue-500 text-white p-3 rounded-full hover:bg-blue-600">
                    <i class="fas fa-paper-plane"></i>
                </button>
            </div>
        </div>
    </div>

    <script>
        async function sendMessage() {
            const userMessage = document.getElementById('user-message').value;
            if (!userMessage) return;

            // نمایش پیام کاربر
            const messageId = Date.now(); // برای تیک‌ها
            appendMessage('شما', userMessage, 'bg-blue-500 text-white mr-4 self-end', messageId, true);
            document.getElementById('user-message').value = '';

            // نمایش وضعیت typing
            setStatus('در حال تایپ...');
            appendTypingIndicator();

            try {
                // ارسال درخواست به سرور لاراول
                const response = await axios.post('/chat', { message: userMessage });
                const botReply = response.data.reply;

                // حذف نشانگر typing
                removeTypingIndicator();
                setStatus('آنلاین');

                // نمایش پاسخ چت‌بات با تیک دوبل
                appendMessage('چت‌بات', botReply, 'bg-gray-600 text-white mr-10 ml-4 self-start', null, false);
                updateTickStatus(messageId, 'double');
            } catch (error) {
                // حذف نشانگر typing
                removeTypingIndicator();
                setStatus('آنلاین');

                // نمایش خطا
                appendMessage('چت‌بات', 'خطا در ارتباط با سرور: ' + error.message, 'bg-red-600 text-white mr-10 ml-4 self-start', null, false);
                updateTickStatus(messageId, 'double');
            }
        }

        function appendMessage(sender, message, className, messageId, isUser) {
            const chatBox = document.getElementById('chat-box');
            const time = new Date().toLocaleTimeString('fa-IR', { hour: '2-digit', minute: '2-digit' });
            const messageDiv = document.createElement('div');
            messageDiv.className = `p-3 m-2 rounded-xl max-w-xs animate-slide-in ${className} shadow-md`;
            messageDiv.innerHTML = `
                <div class="font-bold text-sm">${sender}</div>
                <div>${message}</div>
                <div class="text-xs text-gray-400 mt-1 flex justify-between items-center">
                    <span>${time}</span>
                    ${isUser ? `<span id="tick-${messageId}" class="text-gray-400"><i class="fas fa-check"></i></span>` : ''}
                </div>
            `;
            chatBox.appendChild(messageDiv);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function appendTypingIndicator() {
            const chatBox = document.getElementById('chat-box');
            const typingDiv = document.createElement('div');
            typingDiv.id = 'typing-indicator';
            typingDiv.className = 'p-3 m-2 rounded-xl max-w-xs bg-gray-600 text-white mr-10 ml-4 self-start animate-pulse';
            typingDiv.innerHTML = `
                <div class="font-bold text-sm">چت‌بات</div>
                <div class="flex space-x-1">
                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0s"></span>
                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.2s"></span>
                    <span class="w-2 h-2 bg-gray-400 rounded-full animate-bounce" style="animation-delay: 0.4s"></span>
                </div>
            `;
            chatBox.appendChild(typingDiv);
            chatBox.scrollTop = chatBox.scrollHeight;
        }

        function removeTypingIndicator() {
            const typingIndicator = document.getElementById('typing-indicator');
            if (typingIndicator) typingIndicator.remove();
        }

        function updateTickStatus(messageId, status) {
            const tickElement = document.getElementById(`tick-${messageId}`);
            if (tickElement) {
                tickElement.innerHTML = status === 'double' ? '<i class="fas fa-check-double"></i>' : '<i class="fas fa-check"></i>';
            }
        }

        function setStatus(status) {
            document.getElementById('status').textContent = status;
        }

        // انیمیشن‌های slide-in و bounce
        const style = document.createElement('style');
        style.innerHTML = `
            @keyframes slide-in {
                from { opacity: 0; transform: translateX(20px); }
                to { opacity: 1; transform: translateX(0); }
            }
            .animate-slide-in {
                animation: slide-in 0.3s ease-out;
            }
            @keyframes bounce {
                0%, 100% { transform: translateY(0); }
                50% { transform: translateY(-5px); }
            }
            .animate-bounce {
                animation: bounce 0.6s infinite;
            }
        `;
        document.head.appendChild(style);
    </script>
</body>
</html>
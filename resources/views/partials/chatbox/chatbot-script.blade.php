<script>
    document.getElementById('chat-form').addEventListener('submit', function(e) {
        e.preventDefault();

        let messageInput = document.getElementById('pesan');
        let message = messageInput.value;
        let chatContainer = document.getElementById('chat-container');

        // console.log('Pesan yang dikirim:', message); // Periksa pesan yang dikirim

        // Tambah pesan user ke chat container
        chatContainer.innerHTML += `
                    <div class="chat-message flex gap-3 my-4 text-gray-600 text-sm flex-1">
                        <span class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
                            <div class="rounded-full bg-gray-100 border p-1">
                                <svg stroke="none" fill="black" stroke-width="0" viewBox="0 0 16 16" height="20" width="20"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6Zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0Zm4 8c0 1-1 1-1 1H3s-1 0-1-1
                                             1-4 6-4 6 3 6 4Zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289
                                             10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10Z">
                                    </path>
                                </svg>
                            </div>
                        </span>
                        <p class="leading-relaxed">
                            <span class="block font-bold text-gray-700">You </span>${message}
                        </p>
                    </div>
                `;

        // Clear input
        messageInput.value = "";

        // Kirim ke backend
        fetch('/chatbot/message', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                        .getAttribute(
                            'content')
                },
                body: JSON.stringify({
                    message: message
                })
            })
            .then(response => response.json())
            .then(data => {
                console.log('Respons dari server:', data); // Periksa data yang diterima
                // Tambahkan pesan AI ke chat container
                let html = `
                            <div class="chat-message flex gap-3 my-4 text-gray-600 text-sm flex-1">
                            <span class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
                                <div class="rounded-full bg-gray-100 border p-1">
                                <svg stroke="none" fill="black" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true" height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z"></path>
                                </svg>
                                </div>
                            </span>
                            <div class="leading-relaxed flex-1">
                                <span class="block font-bold text-gray-800">AI</span>
                                <p class="mb-2">${data.response}</p>
                            `;

                if (data.response !== 'Maaf, tidak ada jamu yang cocok dengan kebutuhan Anda.') {
                    html += `
                            <div class="border rounded-xl p-4 shadow-sm bg-gray-50">
                            <div class="flex items-center gap-3 mb-3">
                                <img src="/assets/images/products/${data.gambar ? data.gambar : 'default.png'}" alt="${data.nama_jamu}" class="w-20 h-20 object-cover rounded-lg border">
                                <div>
                                <h4 class="font-semibold text-lg text-gray-800">${data.nama_jamu}</h4>
                                <p class="text-green-600 font-bold">${data.harga}</p>
                                </div>
                            </div>
                            <div class="text-sm text-gray-700 space-y-1">
                                <p><span class="font-semibold">Manfaat:</span> ${data.manfaat}</p>
                                <p><span class="font-semibold">Komposisi:</span> ${data.komposisi}</p>
                                <p><span class="font-semibold">Deskripsi:</span> ${data.deskripsi}</p>
                            </div>
                            </div>
                        `;
                }

                html += `</div></div>`;
                chatContainer.innerHTML += html;
                // Scroll ke bawah
                chatContainer.scrollTop = chatContainer.scrollHeight;
            })
            .catch(error => {
                console.error('Terjadi kesalahan:', error);
            });

    });
</script>

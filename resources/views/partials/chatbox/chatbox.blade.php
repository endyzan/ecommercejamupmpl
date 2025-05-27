<style>
    .chat-message {
        opacity: 0;
        transform: translateY(10px);
        animation: fadeInUp 0.4s ease-out forwards;
        transition: all 0.3s ease;
    }

    #chat-container {
        scroll-behavior: smooth;
    }


    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>


@include('partials.chatbox.chatbox-toggle')

<div id="chatBox"
    class="hidden fixed bottom-[calc(4rem+1.5rem)] right-0 mr-4 bg-white p-6 rounded-lg border border-[#e5e7eb] w-[440px] h-[634px] z-50 overflow-y-auto"
    style="box-shadow: 0 0 #0000, 0 0 #0000, 0 1px 2px 0 rgb(0 0 0 / 0.05);">

    <!-- Heading -->
    <div class="flex flex-col space-y-1.5 pb-6">
        <h2 class="font-semibold text-lg tracking-tight">Chatbot</h2>
        <p class="text-sm text-[#6b7280] leading-3">Powered by Mendable and Vercel</p>
    </div>



    <!-- Chat Container -->
    <div id="chat-container" class="pr-4 h-[474px] overflow-y-auto" style="min-width: 100%;">

        <!-- Starting Message -->
        <div class="chat-message flex gap-3 my-4 text-gray-600 text-sm flex-1">
            <span class="relative flex shrink-0 overflow-hidden rounded-full w-8 h-8">
                <div class="rounded-full bg-gray-100 border p-1">
                    <svg stroke="none" fill="black" stroke-width="1.5" viewBox="0 0 24 24" aria-hidden="true"
                        height="20" width="20" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25
                                 12l2.846-.813a4.5 4.5 0 003.09-3.09L9
                                 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75
                                 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z">
                        </path>
                    </svg>
                </div>
            </span>
            <p class="leading-relaxed">
                <span class="block font-bold text-gray-700">AI </span>
                Apa ada yang bisa saya bantu? Mohon masukkan data keluhan Anda.
            </p>
        </div>


        <!-- Chat messages will be added here dynamically -->


    </div>

    <!-- Input box -->
    <div class="flex items-center pt-0">
        <form id="chat-form" class="flex items-center justify-center w-full space-x-2">
            <input type="text" id="pesan" name="pesan" placeholder="Apa keluhan Anda?"
                class="flex h-10 w-full rounded-md border border-[#e5e7eb] px-3 py-2 text-sm placeholder-[#6b7280] focus:outline-none focus:ring-2 focus:ring-[#9ca3af] disabled:cursor-not-allowed disabled:opacity-50 text-[#030712] focus-visible:ring-offset-2"
                required />
            <button type="submit"
                class="inline-flex items-center justify-center rounded-md text-sm font-medium text-[#f9fafb] disabled:pointer-events-none disabled:opacity-50 bg-black hover:bg-[#111827E6] h-10 px-4 py-2">
                Kirim
            </button>
        </form>
    </div>
</div>

{{-- CHATTING SCRIPT --}}
@include('partials.chatbox.chatbot-script')

{{-- Toggle Button --}}
<script>
    document.getElementById('chatToggle').addEventListener('click', function() {
        const chatBox = document.getElementById('chatBox');
        chatBox.classList.toggle('hidden');
    });
</script>

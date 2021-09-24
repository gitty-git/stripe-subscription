    <div class="text-white z-10 opacity-100 duration-500 absolute top-0 left-0 text-center bg-{{ $colour }}-500" id="session-message">
        <div class="pt-1 px-4 flex">
            {{ $message }}
            <div class="ml-4 text-sm cursor-pointer flex justify-center items-center rounded-full" id="close-session-message">&#10006</div>
        </div>

        <script>
            let sessionMessage = document.getElementById('session-message');
            let SessionMessageCloseBtn = document.getElementById('close-session-message');
            SessionMessageCloseBtn.addEventListener('click', function(event) {
                sessionMessage.innerHTML = '';
            });

            function sessionMessageFadeOut() {
                sessionMessage.classList.remove("opacity-100");
                sessionMessage.classList.add("opacity-0");
                
                setTimeout(function setHidden() {
                    sessionMessage.classList.add("hidden");    
                }, 500);
            }

            setTimeout(sessionMessageFadeOut, 10000);
        </script>
    </div>
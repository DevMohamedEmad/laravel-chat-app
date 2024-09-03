<script src="https://js.pusher.com/8.0.1/pusher.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script>
    const msgerForm = get(".msger-inputarea");
    const msgerInput = get(".msger-input");
    const msgerChat = get(".msger-chat");

    // Icons made by Freepik from www.flaticon.com
    const RECEIVER_NAME = "{{ $receiver->name }}";
    const SENDER_NAME = "{{ auth()->user()->name }}";

    msgerForm.addEventListener("submit", event => {
        event.preventDefault();

        const msgText = msgerInput.value;
        if (!msgText) return;
        appendMessage(msgText,{{ auth()->id() }});
        msgerInput.value = "";
    });

    function appendMessage(message, sender) {
        if (sender == {{ auth()->id() }}) {
            $.post("{{ route('send.message') }}",
            {
                receiver_id:{{ $receiver->id }},
                message:message,
                _token:"{{ csrf_token() }}"
            },
                 function(data) {
            });

            var name = "{{ auth()->user()->name }}"
            var director = "right-msg"

        }else{
            var name = "{{ $receiver->name }}"
            var director = "left-msg"
        }

        const msgHTML = `
            <div class="msg ${director}">
            <div class="msg-bubble">
                <div class="msg-info">
                <div class="msg-info-name">${name}</div>
                <div class="msg-info-time">${formatDate(new Date())}</div>
                </div>

                <div class="msg-text">${message}</div>
            </div>
            </div>
        `;

        msgerChat.insertAdjacentHTML("beforeend", msgHTML);
        msgerChat.scrollTop += 500;
    }

    // Utils
    function get(selector, root = document) {
        return root.querySelector(selector);
    }

    function formatDate(date) {
        const h = "0" + date.getHours();
        const m = "0" + date.getMinutes();

        return `${h.slice(-2)}:${m.slice(-2)}`;
    }
</script>
<script>
    var pusher = new Pusher('2b13bb1c98e1869ca8c1', {
      cluster: 'eu',
      encrypted: true

    });

    var channel = pusher.subscribe('chatApp');
    channel.bind('pusher:subscription_succeeded', function() {
        console.log('Subscribed to channel successfully');
    });

    channel.bind('chatMessage', function(data) {
        if (data.sender_id == {{ auth()->id() }}) return;
        appendMessage(data.message, data.sender_id);
    });
</script>

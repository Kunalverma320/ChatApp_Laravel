<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('css/chat.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Chat</title>
</head>

<body>


    <section class="msger">
        <header class="msger-header">
            <div class="msger-header-title">
                <i class="fas fa-comment-alt"></i> ChatApp {{ $username }}
            </div>
            <div class="msger-header-options">
                <span><i class="fas fa-cog"></i></span>
            </div>
        </header>

        <main class="msger-chat">
            <div class="msg left-msg">

            </div>


        </main>
        <div class="msger-inputarea">
            <input type="hidden" value="{{ $username }}" name="username" id="username">
            <input type="text" class="msger-input" name="message" id="message" placeholder="Enter your message...">
            <button type="submit" class="msger-send-btn" onclick="fireevent();">Send</button>
        </div>
    </section>


    @vite('resources/js/app.js')
    <script>
        function fireevent() {
            var message = $('#message').val();
            var username = $('#username').val();
            $.ajax({
                type: "post",
                url: "/msg",
                data: {
                    message: message,
                    username: username,
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    $('#message').val('');
                    // alert(response.message);

                }
            });
        }
        setTimeout(() => {
            window.Echo.channel('chatMessage').listen('chat', (data) => {
                var messageClass = (data.username === '{{ $username }}') ? 'right-msg' : 'left-msg';

                var newMessage = `
            <div class="msg ${messageClass}">
                <div class="msg-img" style="background-image: url(/img/user.png)"></div>
                <div class="msg-bubble">
                    <div class="msg-info">
                        <div class="msg-info-name">${data.username}</div>
                    </div>
                    <div class="msg-text">
                        ${data.message}
                    </div>
                </div>
            </div>
        `;

                $('.msger-chat').append(newMessage);
            });
        }, 1000);
    </script>


</body>

</html>

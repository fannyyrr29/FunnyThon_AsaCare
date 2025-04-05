<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    
    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    
    <link rel="stylesheet" href="/assets/css/chat.css">
</head>

<body>
    <div class="chat">
        <div class="top">
            <img src="" alt="Avatar">
            <p>Chat id: {{$chat_id}}</p>
        </div>
        <div class="messages">
            @include('users.konsultasi.receive', ['message' => 'Hi, how are you?'])
        </div>
        <div class="bottom">
            <form action="">
                <input type="text" name="message" id="message" placeholder="Enter message..." autocomplete="off">
                <input type="hidden" name="chat_id" id="chat_id" value="{{$chat_id}}">
                <button type="submit"></button>
            </form>
        </div>
    </div>

    <script>
        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {cluster: 'ap1'});
        const chat_id = $('#chat_id').val();
        const channel = pusher.subscribe(chat_id);

        // Receive messages
        channel.bind('chat', function(data) {
            $.post('/konsultasi/receive', {
                _token: '{{ csrf_token() }}',
                chat_id: data.chat_id,
                message: data.message,
            }).done(function(res) {
                $(".messages > .message").last().after(res);
                $(document).scrollTop($(document).height());
            });
        });

        // Broadcast messages
        $("form").submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "/konsultasi/broadcast",
                method: 'POST',
                headers: {
                    'X-Socket-Id': pusher.connection.socket_id
                },
                data: {
                    _token: '{{ csrf_token() }}',
                    chat_id: $('#chat_id').val(),
                    message: $("form #message").val(),
                }
            }).done(function(res) {
                $(".messages > .message").last().after(res);
                $("form #message").val('');
                $(document).scrollTop($(document).height());
            });
        });
    </script>
</body>

</html>

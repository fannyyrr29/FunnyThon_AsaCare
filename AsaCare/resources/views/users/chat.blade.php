<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Chat Layout</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <script src="https://js.pusher.com/8.4.0/pusher.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

    <style>
        body {
            background-color: #fdf7e2;
            height: 100vh;
            margin: 0;
        }

        .card.chat-card {
            border-radius: 15px;
            height: 90vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .chat-header {
            padding: 1rem;
            border-bottom: 1px solid #ddd;
            background-color: #fff;
        }

        .chat-messages {
            flex-grow: 1;
            overflow-y: auto;
            padding: 1rem;
            background-color: #fff;
        }

        .chat-input {
            padding: 0.75rem;
            border-top: 1px solid #ddd;
            background-color: #fff;
        }

        .chat-message-left {
            background-color: #fdf7e2;
            border-radius: 15px;
        }

        .chat-message-right {
            background-color: #a41e1e;
            color: #fff;
            border-radius: 15px;
        }

        .avatar {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 50%;
        }

        .input-group-text span {
            cursor: pointer;
        }
    </style>
</head>

<body>
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10">
                <!-- Full Chat Card -->
                <div class="card chat-card shadow-sm">

                    <!-- Header -->
                    <div class="chat-header d-flex align-items-center">
                        <a href="{{route('user.home')}}" class="me-3 fs-4 text-decoration-none text-dark">
                            <span class="glyphicon glyphicon-chevron-left"></span>
                        </a>
                        <h5 class="mb-0 fw-bold">{{ $doctor_name }}</h5>
                    </div>

                    <!-- Messages -->
                    <div class="chat-messages">
                        @foreach ($messages as $message)
                            @if ($message->sender->id == Auth::id())
                                <div class="d-flex align-items-start justify-content-end mb-3">
                                    <div class="p-3 chat-message-right me-2">
                                        <p class="mb-0 small">{{$message->message}}</p>
                                    </div>
                                </div>
                            @else
                                <div class="d-flex align-items-start mb-3">
                                    <div class="p-3 chat-message-left">
                                        <p class="mb-0 small">{{$message->message}}</p>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                        
                        {{-- <!-- Chat kiri -->
                            <div class="d-flex align-items-start mb-3">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava5-bg.webp"
                                    alt="avatar" class="avatar me-2" />
                                <div class="p-3 chat-message-left">
                                    <p class="mb-0 small">Hi there!</p>
                                </div>
                            </div>

                            <!-- Chat kanan -->
                            <div class="d-flex align-items-start justify-content-end mb-3">
                                <div class="p-3 chat-message-right me-2">
                                    <p class="mb-0 small">Hello! How can I help?</p>
                                </div>
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava6-bg.webp"
                                    alt="avatar" class="avatar" />
                            </div> --}}

                    </div>

                    <!-- Input -->
                    <form action="" method="POST">
                        <div class="chat-input d-flex align-items-center gap-2">

                            <input type="hidden" name="doctor_name" id="doctor_name" value="{{ $doctor_name }}">
                            <input type="hidden" name="consultation_id" id="consultation_id" value="{{ $consultation_id }}">
                            <input type="hidden" name="sender_id" id="sender_id" value="{{ Auth::id() }}">
                            <input type="text" class="form-control" name="message" id="message"
                                placeholder="Type message..." autocomplete="off">
                            {{-- <a class="ms-1 text-muted" href="#!">
                                <span class="glyphicon glyphicon-paperclip"></span>
                            </a> 
                            <a class="ms-3" href="#!">
                                <span class="glyphicon glyphicon-send"></span>
                            </a> --}}
                            <button class="ms-3" type="submit"><span
                                    class="glyphicon glyphicon-send"></span></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        const pusher = new Pusher('{{ config('broadcasting.connections.pusher.key') }}', {
            cluster: 'ap1'
        });
        const consultation_id = $('#consultation_id').val();
        const channel = pusher.subscribe(consultation_id);

        // Receive messages
        channel.bind('chat', function(data) {
            $.post('/message/user/receive', {
                _token: '{{ csrf_token() }}',
                consultation_id: data.consultation_id,
                message: data.message,
            }).done(function(res) {
                const receivedMessageHtml = `
                <div class="d-flex align-items-start mb-3">
                    <div class="p-3 chat-message-left">
                        <p class="mb-0 small">${data.message}</p>
                    </div>
                </div>`;

                $(".chat-messages").append(receivedMessageHtml);
                $(document).scrollTop($(document).height());
            });
        });

        // Broadcast messages
        $("form").submit(function(event) {
            event.preventDefault();

            $.ajax({
                url: "/message/user/broadcast",
                method: 'POST',
                headers: {
                    'X-Socket-Id': pusher.connection.socket_id
                },
                data: {
                    _token: '{{ csrf_token() }}',
                    consultation_id: $('#consultation_id').val(),
                    sender_id: $('#sender_id').val(),
                    message: $("form #message").val(),
                }
            }).done(function(res) {
                // Menambahkan struktur HTML untuk chat kanan (pesan dikirim)
                const sentMessageHtml = `
               <div class="d-flex align-items-start justify-content-end mb-3">
                   <div class="p-3 chat-message-right me-2">
                       <p class="mb-0 small">${$("form #message").val()}</p>
                   </div>
               </div>`;

                $(".chat-messages").append(sentMessageHtml);
                $("form #message").val('');
                $(document).scrollTop($(document).height());
            });
        });
    </script>
</body>

</html>

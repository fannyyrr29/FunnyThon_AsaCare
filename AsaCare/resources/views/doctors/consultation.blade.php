<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Daftar Chat</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            background-color: #fdf7e2;
        }

        .container-fluid {
            height: 100%;
        }

        .chat-container {
            height: 100%;
            border-radius: 15px;
            overflow: hidden;
            background-color: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            flex-direction: column;
        }

        .chat-header {
            padding: 1rem;
            border-bottom: 1px solid #eee;
        }

        .chat-body {
            flex-grow: 1;
            overflow-y: auto;
            padding: 1rem;
        }

        .chat-item {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
            transition: background 0.2s;
            border-radius: 10px;
            padding: 0.5rem;
        }

        .chat-item:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }

        .chat-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 50%;
        }

        .chat-info {
            margin-left: 1rem;
        }

        .chat-info h6 {
            margin: 0;
            font-weight: bold;
        }

        .chat-info p {
            margin: 0;
            font-size: 0.875rem;
            color: #6c757d;
        }
    </style>
</head>

<body>
    <div class="py-5 container-fluid">
        <div class="row h-100 justify-content-center align-items-center">
            <div class="col-md-10 col-xl-8 h-100">
                <div class="chat-container">
                    <!-- Header -->
                    <div class="chat-header">
                        <input type="search" class="form-control" id="searchInput" placeholder="Cari kontak..." />
                    </div>

                    <!-- Body chat list -->
                    <div class="chat-body">
                        <!-- Contoh chat -->
                        @foreach ($consultations as $consultation)
                            <form action="{{ route('doctor.message') }}" method="POST">
                                @csrf
                                <input type="hidden" name="consultation_id" value="{{ $consultation->id }}">
                                <input type="hidden" name="user_name" value="{{ $consultation->user->name }}">
                                <button type="submit" style="all: unset; cursor: pointer; width: 100%;">
                                    <div class="chat-item">
                                        <img src="assets/images/profile/{{ $consultation->user->profile }}"
                                            alt="Avatar" />
                                        <div class="chat-info">
                                            <h6 class="chat-name">{{ $consultation->user->name }}</h6>
                                        </div>
                                    </div>
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const chatItems = document.querySelectorAll('.chat-item');

            chatItems.forEach(function(item) {
                const name = item.querySelector('.chat-name').textContent.toLowerCase();
                if (name.includes(searchTerm)) {
                    item.closest('form').style.display = ''; // tampilkan
                } else {
                    item.closest('form').style.display = 'none'; // sembunyikan
                }
            });
        });
    </script>
</body>

</html>

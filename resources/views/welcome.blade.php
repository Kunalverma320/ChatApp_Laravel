<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=., initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chat App</title>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
</head>

<body>

    <div class="container">
        <div class="container-fluid">
            <div class="row main-content bg-success text-center">
                <div class="col-md-12 text-center company__info">
                    <span class="company__logo">
                        <h2><span class="fa fa-android"></span></h2>
                    </span>
                    <h4 class="company_title">

                        <form method="post" class="form-group" id="user-save">
                            @csrf
                            <div class="row">
                                @if (session('error'))
                                    <div class="alert alert-danger">
                                        {{ session('error') }}
                                    </div>
                                @endif
                                <span class="final_succ"></span>

                            </div>
                            <div class="row">
                                <input type="text" name="username" id="username" class="form__input"
                                    placeholder="Enter Your Name">
                                <span class="user_error"></span>
                            </div>

                            <div class="row">
                                <button type="submit" class="btn">Submit</button>
                            </div>
                        </form>
                </div>
                </h4>


            </div>
        </div>




    </div>


    <script>
        $(document).ready(function() {
            $('#user-save').on('submit', function(e) {
                e.preventDefault();
                var username = $('#username').val();
                $.ajax({
                    type: "POST",
                    url: "/usersave",
                    data: {
                        _token: "{{ csrf_token() }}",
                        username: username,
                    },
                    success: function(response) {

                        $('.user_error').text('');
                        if (response.status === 422) {
                            if (response.error.username) {
                                $('.user_error').text(response.error.username[0]);
                            }
                        } else if (response.status === 200) {
                            $('.final_succ').text('User Enter successful! Redirecting...');
                            setTimeout(function() {
                                window.location.href = "/chat?username=" + response
                                    .username;
                            }, 2000);
                        } else if (response.status == 401) {
                            $('.final_succ').text(response.message);
                        }
                        console.log(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });
        });
    </script>



</body>

</html>

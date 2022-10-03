@extends('layout.auth')
@section('content')
    <div class="card-body login-card-body">
        <p class="login-box-msg">Sign in</p>

        <form action="" id="login-form">
            @csrf
            <div class="input-group">
                <input type="email" class="form-control" placeholder="Email" name="email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mt-3">
                <input type="password" class="form-control" placeholder="Password" name="password">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-8">
                    <div class="icheck-primary">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember">
                            Keep me sign in
                        </label>
                    </div>
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <p class="mb-1 mt-3">
            <a href="forgot-password.html">I forgot my password</a>
        </p>
        <p class="mb-0">
            <a href="{{ url('register') }}" class="text-center">Register a new membership</a>
        </p>
    </div>
    <!-- /.login-card-body -->
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.login-card-body').on('submit', 'form', function(event) {
            event.preventDefault();
            data = $(this).serialize();
            console.log(data);
            $.ajax({
                type: 'POST',
                url: "{{ url('login') }}",
                dataType: "JSON",
                data: data,
                success: function(data) {
                    $('#login-form .error').text('');
                    if (data.status == true) window.location.href = data.redirect;
                    if (data.status == 'failed') {
                        // toast('error', data.message);
                    }
                },
                error: function(data) {
                    $('#login-form .error').text('');
                    $.each(data.responseJSON.errors, function(field_name, error) {
                        $('#login-form').find('[name=' + field_name + ']')
                            .closest('div').after(
                                `<span class="error text-danger">${error}</span>`);
                    })
                }
            })
        })
    </script>
@endsection

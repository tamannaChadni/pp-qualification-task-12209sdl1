@extends('layout.auth')
@section('content')
    <div class="card-body register-card-body">
        <p class="login-box-msg">Register for use the wallet</p>

        <form action="" method="" id="register-form">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Full name" name="name">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            <div class="input-group mt-3">
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
                    <div class="form-group">
                        
                        <select class="custom-select rounded-0" name="account_type">
                          <option>Account Type</option>
                          <option value="0">Personal Account</option>
                          <option value="1">Agent Account</option>
                        </select>
                      </div>
                   
                </div>
                <!-- /.col -->
                <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Register</button>
                </div>
                <!-- /.col -->
            </div>
        </form>
        <a href="{{ url('login') }}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
@endsection
@section('script')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.register-card-body').on('submit', 'form', function(event) {
            event.preventDefault();
            data = $(this).serialize();
            console.log(data);
            $.ajax({
                type: 'POST',
                url: "{{ url('register') }}",
                data: data,
                success: function(data) {
                    $('#register-form .error').text('');
                    toastr.success('success', data.message);
                    setTimeout(() => {
                        window.location.href = data.redirect
                    }, 3000);
                },
                error: function(data) {
                    $('#register-form .error').text('');
                    $.each(data.responseJSON.errors, function(field_name, error) {
                        $('#register-form').find('[name=' + field_name + ']')
                            .closest('div').after(
                                `<span class="error text-danger">${error}</span>`);
                    })
                }
            })
        })
    </script>
@endsection

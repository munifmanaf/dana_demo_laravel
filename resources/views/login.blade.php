@extends('layouts.master')

@section('content')
    {{-- <section> --}}
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="img-dana">
                        <img class="img1" src="{{url('imgs/dana_logo.png')}}" alt="">
                    </div>
                </div>
                <div class="col-6">
                    <div class="wrapper">
                        <form action="">
                            <h1>Login</h1>
                            <div class="input-box">
                                <input type="text" name="ic" id="ic" placeholder="Enter IC">
                                <i class='bx bxs-user'></i>
                            </div>
                            <div class="input-box">
                                <input type="password" name="password" id="password" placeholder="Enter Password">
                                <i class='bx bxs-lock-alt'></i>
                            </div>
                            <div class="btn-sub" style="margin-top: 30px">
                                <button type="submit" class="btn-md btn btn-success btn-block" id="login_btn">Login</button>
                            </div>
                            <div class="register-link">
                                <p>Don't have a account?  
                                <button type="button" class="btn-sm" id="red_reg">Register</button></p>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    {{-- </section> --}}
@endsection

@push('scripts')

<script>
    $(document).ready(function(){
        $('#login_btn').click(function(e){

            $.ajaxSetup({
                headers: {
                    'X_CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })
            e.preventDefault()
            var ic = $('#ic').val()
            var password = $('#password').val()

            $.ajax({
                url: 'user_login',
                type: 'POST',
                data: {
                    ic: ic,
                    password: password
                },
                success: function(data){
                    if($.isEmptyObject(data.error)){
                        if(data.success){
                            $('#noti').fadeIn();
                            $('#noti').css('background', 'green');
                            $('#noti').text('User Login Successfully');
                            setTimeout(() => {
                                $('#noti').fadeOut();
                            }, 3000);
                            if(data.is_admin == 1){
                                window.location = "{{ route('admin') }}"
                            }else{
                                window.location = "{{ route('user') }}"
                            }
                            // 
                        }
                    }else{
                        $('#noti').fadeIn();
                        $('#noti').css('background', 'red');
                        $('#noti').text('Login Failed');
                        setTimeout(() => {
                        $('#noti').fadeOut();
                        }, 3000);
                    }
                }
            })
        })

        $('#red_reg').click(function(){
            window.location = "{{ route('register') }}"
        })
    })
</script>

@endpush
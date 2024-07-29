@extends('layouts.master')

@section('content')
    <section>
        <div class="wrapper">
            <form action="">
                @csrf
                <h1>Register</h1>
                <div class="input-box">
                    <input type="text" name="ic" id="ic" placeholder="Enter IC">
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="name" id="name" placeholder="Enter name">
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" id="password" placeholder="Enter Password">
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="phone_no" id="phone_no" placeholder="Enter Phone Number">
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input-box">
                    <input type="text" name="address" id="address" placeholder="Enter Address">
                    <i class='bx bxs-user'></i>
                </div>
                <div class="btn-sub" style="margin-top: 30px">
                    <button type="submit" class="btn-md btn btn-success btn-block" id="register">Register</button>
                </div>
            </form>
        </div>
    </section>
@endsection

@push('scripts')

<script>
    $(document).ready(function(){
        $('#register').on('click', function(e){

            var ic = $('#ic').val()
            var name = $('#name').val()
            var password = $('#password').val()
            var phone_no = $('#phone_no').val()
            var address = $('#address').val()
            var form = $(this).parents('form')
            $(form).validate({
                rules: {
                    ic: {
                        required: true
                    },
                    name: {
                        required: true
                    },
                    password: {
                        required: true
                    },
                    phone_no: {
                        required: true
                    },
                    address: {
                        required: true
                    },
                },
                messages:{
                    ic:"IC is required.",
                    name:"Name is required.",
                    password:"Password is required.",
                    phone_no:"Phone No. is required.",
                    address:"Address is required.",
                },
                submitHandler: function(){
                    var formData = new FormData(form[0]);
                    $.ajax({
                        type: 'POST',
                        url: 'save_user',
                        data: formData,
                        dataType: 'JSON',
                        processData: false,
                        contentType: false,
                        success:function(data) {
                            if(data.exists){
                              $('#noti').fadeIn();
                              $('#noti').css('background', 'red');
                              $('#noti').text('IC already exist');
                              setTimeout(() => {
                                $('#noti').fadeOut();
                              }, 3000);  
                            }else if(data.success){
                                $('#noti').fadeIn();
                                $('#noti').css('background', 'green');
                                $('#noti').text('User registered Successfully');
                                setTimeout(() => {
                                    $('#noti').fadeOut();
                                }, 3000);
                                $('#ic').val('')
                                $('#name').val('')
                                $('#password').val('')
                                $('#phone_no').val('')
                                $('#address').val('')
                            }
                        }
                    })
                }
            })
        })
    })
</script>

@endpush
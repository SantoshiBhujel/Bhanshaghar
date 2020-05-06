{{-- @if(session('Error'))

<div class=" alert alert-danger"></div>

{!! session('Error')!!}
@endif --}}


@section('scripts')

        @if(count($errors) >0)
            @foreach ($errors->all() as  $error)
                <div class="alert alert-danger ">
                    {{$error}}
                </div>
            @endforeach
        @endif  

        @if (Session::has('Success'))
            <script>
                // {{--<button type="button" class="close" data-dismiss="alert">×</button>--}}
                swal("One more step!","{!! session('Success')!!}" ,"success")
            </script>
        @endif


        @if (Session::has('alreadyincart'))
            <script>
                // {{--<button type="button" class="close" data-dismiss="alert">×</button>--}}
                swal("Whoops!","{!! session('alreadyincart')!!}")
            </script>
        @endif


        @if (Session::has('Email'))

            <script>
                swal({
                    title:"Your account is yet to active!",
                    text: "Want the code again ? If yes, click OK",
                    type:"error",
                    showCancelButton: true,
                    closeOnConfirm: false,
                    showLoaderOnConfirm: true,
                    },
                    function(){
                        setTimeout(function(){
                            $.get('/resend/code',{email: "{!! session('Email')!!}" });
                            swal("Email sent!");
                        },2000);
                    }
                );
            </script>
            {{-- <strong>{!! session('Error')!!}</strong> --}}
        @endif


        @if (Session::has('success'))
            <script>
                swal("Wow!","{!! session('success')!!}" ,"success")
            </script>
        @endif



        @if (Session::has('error'))
            <script>
                swal("","{!! session('error')!!}")
            </script>
        @endif


        @if(session('posterror'))
            <div class=" alert alert-danger">{!! session('posterror')!!}</div>
        @endif


@endsection
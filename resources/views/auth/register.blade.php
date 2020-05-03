@extends('layout')

@section('body')

<section class="signup">
    <div class="container">
        <h1>Sign UP here !!</h1>

        <form  action="{{route('register') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="form-group row">
                <div class="form-group col-sm-12 col-md-6">
                    <label for="">{{ __('Name') }}</label>
                    
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                   
                </div>
            
                <div class="form-group col-sm-12 col-md-6">
                    <label for="email">{{ __('Email') }}</label>
                
                    
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    
                </div>
            </div>

            
            <div class="form-group row">
                <div class="form-group col-sm-12 col-md-6">
                    <label for="">Address</label>
                    <input type="text" name="address" class="form-control" id="address" placeholder="Enter address" required>
                </div>

                <div class="form-group col-sm-12 col-md-6">
                    <label for="">Phone Number</label>
                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone no." required>
                </div>
            </div>

            <div class="form-group col-sm-12 col-md-6">
                    <input id="cover_image" type="hidden" class="form-control @error('password') is-invalid @enderror" name="cover_image">
            </div>
            <div class="form-group row">
                <div class="form-group col-sm-12 col-md-6">
                    <label for="">{{ __('Password') }}</label>
                    
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                </div>

                <div class="form-group col-sm-12 col-md-6">
                    <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">   
                </div>
            </div>
            
          
            <button type="submit" class="btn btn-primary" name="signup" value="submit"> {{ __('Register') }}</button>
        </form>
    </div>
</section>

@endsection

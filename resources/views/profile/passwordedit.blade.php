@extends('layout')

@section('body')
<section class="signup">
    <div class="container">
        <h1>Change Your Password here !!</h1>
        <form action="{{route('password.edit')}}" method="post">
    
            @csrf   {{-- token pathako --}}
  
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
            
        
            <button type="submit" class="btn btn-primary" name="signup" value="submit"> {{ __('Change') }}</button>
        </form>

</div>
</section>
@endsection
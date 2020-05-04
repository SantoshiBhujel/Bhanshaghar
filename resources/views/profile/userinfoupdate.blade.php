@extends('layout')


@section('body')
    

    <section class="signup">
        <div class="container">
            <h1>Update Your Profile here !!</h1>
    
            <form  action="{{route('userinfo.edit') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-group row">
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="">{{ __('Name') }}</label>
                        
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ auth()->user()->name}}" required autocomplete="name" autofocus>
    
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                       
                    </div>
                
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="email">{{ __('Email') }}</label>
                    
                        
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ auth()->user()->email}}"autocomplete="email">
    
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
                        <input type="text" name="address" class="form-control" id="address" placeholder="Enter address" value="{{ auth()->user()->address}}">
                    </div>
    
                    <div class="form-group col-sm-12 col-md-6">
                        <label for="">Phone Number</label>
                        <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter phone no." value="{{ auth()->user()->phone}}">
                    </div>
                </div>
                <input type="hidden" name="active" class="form-control" id="active" value="0">
              
                <button type="submit" class="btn btn-primary" name="signup" value="submit"> {{ __('Update') }}</button>
            </form>
        </div>
    </section>
@endsection
<form action="{{route('propicupdate')}}" method="post" enctype="multipart/form-data">
        @csrf   {{-- token pathako --}}
      
        <i class="fa fa-camera" aria-hidden="true"></i>
        <input type="file" name="profile_image" ><br><br>
       
        <input type="submit" name="submit" value="Update">
 </form>
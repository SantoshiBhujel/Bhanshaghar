{{-- <form action="{{ route('item.search') }}" method="post">
    <i class="fas fa-search"></i>
    <button type="submit" name='query' id ='query' class-box="search-box" placeholder="Search for the item"></button>
</form> --}}


<form action="{{ route('item.search') }}" method="get" class="form-inline d-flex justify-content-center md-form form-sm active-pink active-pink-2 mt-2" >
    <i class="fas fa-search" aria-hidden="true"></i>
    <input class="form-control form-control-sm ml-3 w-75" name='query' id ='query' value="{{request()->input('query')}}" type="text" placeholder="Search for item"
      aria-label="Search">
     
  </form>
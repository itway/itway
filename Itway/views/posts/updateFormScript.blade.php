@if(isset($tags) && count($tags) !==0 )
    @foreach($tags as $tag)
        <option value="{{$tag}}" selected="">{{$tag}}</option>
    @endforeach
@endif
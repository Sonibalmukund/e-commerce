@extends('layouts.app')

@section('content')
<div class="container">
    <h2>All Categories</h2>
    <ul>
        @foreach($categories as $cat)
            <li>
                <strong>{{ $cat->name }}</strong>
                <ul>
                    @foreach($cat->subcategories as $sub)
                        <li>{{ $sub->name }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
</div>
@endsection

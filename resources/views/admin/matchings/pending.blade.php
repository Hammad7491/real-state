@extends('layouts.app')
@section('title','Pending Matches')

@section('content')
<div class="container my-5">
  <h2>Buyers with Matches</h2>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>Buyer</th>
        <th># Sellers</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($buyers as $b)
      <tr>
        <td>
          <strong>{{ $b->name }}</strong><br>
          <small>{{ $b->email }}</small>
        </td>
        <td>{{ $b->match_count }}</td>
        <td>
          <a href="{{ route('admin.matching.show',$b) }}" class="btn btn-sm btn-primary">
            View Details
          </a>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection

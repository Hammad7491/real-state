@extends('layouts.app')

@section('title') Matches for {{ $buyer->name }} @endsection

@section('content')
<div class="container my-5">
  {{-- Buyer header + details --}}
  <div class="mb-4">
    <h2 class="mb-1">Matches for <strong>{{ $buyer->name }}</strong></h2>
    <p class="mb-0">
      <small>Email: <a href="mailto:{{ $buyer->email }}">{{ $buyer->email }}</a>
      | Phone: {{ $buyer->phone ?? '—' }}</small>
    </p>
    @if($buyer->notes)
      <p class="mt-2"><em>Notes:</em> {{ $buyer->notes }}</p>
    @endif
    <a href="{{ route('admin.matching.pending') }}" class="btn btn-link px-0">&larr; Back to Pending</a>
  </div>

  @forelse($matches as $info)
    @php $s = $info['seller']; $hits = $info['matched']; @endphp

    <div class="row mb-4 p-3 border rounded shadow-sm">
      {{-- Seller profile --}}
      <div class="col-md-6">
        <h5 class="mb-3"><i class="bx bx-home-alt me-1"></i> Seller: {{ $s->name }}</h5>
        <p class="mb-1"><strong>Email:</strong> <a href="mailto:{{ $s->email }}">{{ $s->email }}</a></p>
        <p class="mb-1"><strong>Phone:</strong> {{ $s->phone ?? '—' }}</p>
        <hr>
        <h6>Property Details</h6>
        <p class="mb-1">
          <strong>Address:</strong><br>
          {{ $s->property_address }},<br>
          {{ $s->property_city }}, {{ $s->property_state }} {{ $s->property_zip }}
        </p>
        <p class="mb-1">
          <strong>Type:</strong> {{ $s->property_type }}<br>
          <strong>Price:</strong> ${{ number_format($s->asking_price) }}<br>
          <strong>Beds:</strong> {{ $s->bedrooms ?? '—' }}
          |
          <strong>Baths:</strong> {{ $s->bathrooms ?? '—' }}<br>
          <strong>Sqft:</strong> {{ $s->square_footage ?? '—' }}
        </p>
        @if($s->additional_details)
          <p class="mt-2"><em>{{ $s->additional_details }}</em></p>
        @endif
      </div>

      {{-- Buyer’s criteria + which matched --}}
      <div class="col-md-6 border-start ps-4">
        <h6><i class="bx bx-list-ul me-1"></i> Buyer’s Criteria</h6>
        <ul class="mb-3">
          @foreach($buyer->criteria as $c)
            <li>
              <code>{{ $c->field }} {{ $c->operator }} {{ $c->value }}</code>
              @if(in_array(
                   "{$c->field} {$c->operator} {$c->value}",
                   $hits,
                   true
                 ))
                <span class="badge bg-success ms-2">✔ Matched</span>
              @else
                <span class="badge bg-secondary ms-2">✘</span>
              @endif
            </li>
          @endforeach
        </ul>

        <h6><i class="bx bx-check-circle me-1"></i> Actually Matched</h6>
        @if(count($hits))
          <ul>
            @foreach($hits as $hit)
              <li>{{ $hit }}</li>
            @endforeach
          </ul>
        @else
          <p><em>No criteria matched (shouldn’t happen here).</em></p>
        @endif
      </div>
    </div>
  @empty
    <div class="alert alert-warning">
      No sellers match <strong>{{ $buyer->name }}</strong>’s criteria.
    </div>
  @endforelse
</div>
@endsection

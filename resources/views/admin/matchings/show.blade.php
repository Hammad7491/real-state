@extends('layouts.app')

@section('title') Matches for {{ $buyer->name }} @endsection

@push('styles')
<style>
  .bg-gradient-primary{background:linear-gradient(45deg,#0d6efd,#6610f2)!important}
  .page-wrap{max-width:1100px}
  .buyer-head .avatar{width:40px;height:40px;border-radius:10px;object-fit:cover}
  .match-card{border:1px solid #edf0f7;border-radius:12px;background:#fff}
  .match-card:hover{box-shadow:0 6px 20px rgba(13,110,253,.08)}
  .muted{color:#6b7280}
  .badge-soft{background:#f4f6ff;border:1px solid #cdd8ff;color:#4255ff}
  code{background:#f6f8ff;border-radius:6px;padding:.1rem .35rem}
</style>
@endpush

@section('content')
<div class="container my-5 page-wrap">

  {{-- Header --}}
  <div class="card shadow-sm border-0 rounded-3 mb-4">
    <div class="card-header bg-gradient-primary text-white d-flex align-items-center justify-content-between">
      <h4 class="mb-0 d-flex align-items-center">
        <i class="ri-links-line me-2"></i>
        Matches for {{ $buyer->name }}
      </h4>
      <div class="d-flex gap-2">
        <a href="{{ route('admin.matching.pending') }}" class="btn btn-light btn-sm">
          <i class="ri-arrow-left-line me-1"></i> Back to Pending
        </a>
        <a href="mailto:{{ $buyer->email }}" class="btn btn-outline-light btn-sm">
          <i class="ri-mail-line me-1"></i> Email Buyer
        </a>
      </div>
    </div>
    <div class="card-body buyer-head">
      <div class="d-flex align-items-start gap-3">
        <img class="avatar" src="{{ $buyer->avatar_url ?? asset('assets/images/user.png') }}" alt="">
        <div>
          <div class="fw-semibold">{{ $buyer->name }}</div>
          <small class="muted">
            <i class="ri-at-line me-1"></i><a href="mailto:{{ $buyer->email }}">{{ $buyer->email }}</a>
            @if($buyer->phone) <span class="mx-2">•</span><i class="ri-phone-line me-1"></i>{{ $buyer->phone }} @endif
          </small>
          @if($buyer->notes)
            <div class="mt-2"><small class="muted"><em>{{ $buyer->notes }}</em></small></div>
          @endif
        </div>
      </div>
    </div>
  </div>

  {{-- Matches List --}}
  @php $total = is_countable($matches) ? count($matches) : 0; @endphp

  @if($total === 0)
    <div class="alert alert-warning">
      No sellers match <strong>{{ $buyer->name }}</strong>’s criteria.
    </div>
  @else
    @foreach($matches as $i => $info)
      @php
        // Normalize data so it works whether $info is array or object
        $seller = is_array($info)
                    ? ($info['seller'] ?? $info['s'] ?? null)
                    : ($info->seller ?? $info);

        // Matched rules can be array, collection, or null
        $hitsRaw = is_array($info)
                    ? ($info['matched'] ?? $info['hits'] ?? [])
                    : ($info->matched ?? $info->hits ?? []);
        $hits = $hitsRaw instanceof \Illuminate\Support\Collection ? $hitsRaw->toArray() : (array) $hitsRaw;

        // Guard against null seller
        /** @var \App\Models\Seller|null $s */
        $s = $seller;

        $sl = str_pad($i+1,2,'0',STR_PAD_LEFT);
      @endphp

      <div class="match-card p-3 p-md-4 mb-3">
        <div class="row g-3">
          {{-- Left: Seller + property summary --}}
          <div class="col-md-6">
            <div class="d-flex align-items-start gap-3">
              <img src="{{ $s->avatar_url ?? asset('assets/images/user-list/user-list1.png') }}" alt="" style="width:40px;height:40px;object-fit:cover;border-radius:8px">
              <div class="flex-grow-1">
                <div class="d-flex align-items-center gap-2">
                  <span class="badge text-bg-light">{{ $sl }}</span>
                  <h5 class="mb-0">{{ $s->name ?? '—' }}</h5>
                </div>
                <small class="muted d-block mt-1">
                  <a href="mailto:{{ $s->email }}">{{ $s->email }}</a>
                  @if($s->phone)  • {{ $s->phone }} @endif
                </small>

                <div class="mt-3">
                  <div class="text-uppercase text-secondary small fw-semibold mb-1">Property</div>
                  <div class="mb-1">
                    <strong class="me-1">{{ $s->property_type ?? '—' }}</strong>
                  </div>
                  <small class="muted d-block">
                    {{ $s->property_address }},
                    {{ $s->property_city }}, {{ $s->property_state }} {{ $s->property_zip }}
                  </small>
                </div>

                @if($s->additional_details)
                  <small class="d-block mt-2"><em>{{ $s->additional_details }}</em></small>
                @endif
              </div>
            </div>
          </div>

          {{-- Right: Numbers + matched count --}}
          <div class="col-md-6">
            <div class="row g-2 g-md-3">
              <div class="col-6 col-md-4">
                <div class="small text-secondary">Price</div>
                <div class="fw-semibold">${{ number_format($s->asking_price) }}</div>
              </div>
              <div class="col-6 col-md-4">
                <div class="small text-secondary">Beds / Baths</div>
                <div class="fw-semibold">
                  {{ $s->bedrooms ?? '—' }} / {{ $s->bathrooms ?? '—' }}
                </div>
              </div>
              <div class="col-6 col-md-4">
                <div class="small text-secondary">Sqft</div>
                <div class="fw-semibold">
                  {{ $s->square_footage ? number_format($s->square_footage) : '—' }}
                </div>
              </div>
              <div class="col-12 mt-2">
                <span class="badge badge-soft rounded-pill px-3">
                  {{ count($hits) }} matched
                </span>
              </div>
            </div>
          </div>
        </div>

        {{-- Divider --}}
        <hr class="my-3">

        {{-- Criteria + exact matches --}}
        <div class="row g-4">
          <div class="col-md-6">
            <h6 class="mb-2"><i class="ri-list-check-2 me-1"></i> Buyer’s Criteria</h6>
            <ul class="mb-0">
              @foreach($buyer->criteria as $c)
                @php $expr = "{$c->field} {$c->operator} {$c->value}"; @endphp
                <li class="mb-1">
                  <code>{{ $expr }}</code>
                  @if(in_array($expr, $hits, true))
                    <span class="badge bg-success ms-2">✔ Matched</span>
                  @else
                    <span class="badge bg-secondary ms-2">✘</span>
                  @endif
                </li>
              @endforeach
            </ul>
          </div>
          <div class="col-md-6">
            <h6 class="mb-2"><i class="ri-check-double-line me-1"></i> Actually Matched</h6>
            @if(count($hits))
              <ul class="mb-0">
                @foreach($hits as $hit)
                  <li>{{ $hit }}</li>
                @endforeach
              </ul>
            @else
              <p class="mb-0 muted"><em>No criteria matched.</em></p>
            @endif
          </div>
        </div>
      </div>
    @endforeach

    <div class="d-flex justify-content-between align-items-center mt-3">
      <small class="text-secondary">Total Sellers: <strong>{{ $total }}</strong></small>
      <small class="text-secondary">Updated: <strong>{{ now()->format('d M Y, h:i A') }}</strong></small>
    </div>
  @endif
</div>
@endsection

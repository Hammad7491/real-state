@extends('layouts.app')

@section('title', $buyer->exists ? 'Edit Buyer' : 'New Buyer')

@push('styles')
<style>
  /* Subtle polish */
  .criteria-row { position: relative; }
  .criteria-row .remove-criteria {
    position: absolute; top: 8px; right: 8px;
  }
  .icon-field .icon { display: inline-flex; align-items: center; justify-content: center; }
</style>
@endpush

@section('page-header')
  <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
    <h6 class="fw-semibold mb-0">{{ $buyer->exists ? 'Edit Buyer' : 'New Buyer' }}</h6>
    <ul class="d-flex align-items-center gap-2">
      <li class="fw-medium">
        <a href="{{ route('admin.dashboard') }}" class="d-flex align-items-center gap-1 hover-text-primary">
          <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
          Dashboard
        </a>
      </li>
      <li>-</li>
      <li class="fw-medium">Buyers</li>
    </ul>
  </div>
@endsection

@section('content')
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul class="mb-0">@foreach ($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
  @endif

  <div class="row gy-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h5 class="card-title mb-0">
            <span class="me-8 w-36-px h-36-px bg-primary-50 text-primary-600 rounded-circle d-inline-flex align-items-center justify-content-center">
              <iconify-icon icon="solar:user-plus-outline" class="text-lg"></iconify-icon>
            </span>
            {{ $buyer->exists ? 'Edit Buyer' : 'Create Buyer' }}
          </h5>
        </div>

        <div class="card-body">
          <form class="row gy-3 needs-validation" novalidate
                method="POST"
                action="{{ $buyer->exists ? route('admin.buyers.update',$buyer) : route('admin.buyers.store') }}">
            @csrf
            @if($buyer->exists) @method('PUT') @endif

            {{-- Buyer Info --}}
            <div class="col-12">
              <div class="row gy-3">
                <div class="col-md-6">
                  <label class="form-label">Name</label>
                  <div class="icon-field has-validation">
                    <span class="icon"><iconify-icon icon="f7:person"></iconify-icon></span>
                    <input type="text" name="name"
                           class="form-control @error('name') is-invalid @enderror"
                           placeholder="Enter full name"
                           value="{{ old('name', $buyer->name) }}" required>
                    <div class="invalid-feedback">@error('name') {{ $message }} @else Please provide a name. @enderror</div>
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Email</label>
                  <div class="icon-field has-validation">
                    <span class="icon"><iconify-icon icon="mage:email"></iconify-icon></span>
                    <input type="email" name="email"
                           class="form-control @error('email') is-invalid @enderror"
                           placeholder="Enter email"
                           value="{{ old('email', $buyer->email) }}" required>
                    <div class="invalid-feedback">@error('email') {{ $message }} @else Please provide an email. @enderror</div>
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Phone</label>
                  <div class="form-mobile-field">
                    {{-- optional country code (kept simple) --}}
                    <select class="form-select" name="phone_country">
                      @php $pc = old('phone_country', $buyer->phone_country ?? 'US'); @endphp
                      <option value="US" @selected($pc==='US')>US</option>
                      <option value="GB" @selected($pc==='GB')>GB</option>
                      <option value="CA" @selected($pc==='CA')>CA</option>
                    </select>
                    <input type="text" name="phone"
                           class="form-control @error('phone') is-invalid @enderror"
                           placeholder="+1 (555) 000-0000"
                           value="{{ old('phone', $buyer->phone) }}">
                    @error('phone')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <label class="form-label">Joined At</label>
                  <input type="date" name="joined_at" class="form-control"
                         value="{{ old('joined_at', optional($buyer->joined_at ?? null)->format('Y-m-d')) }}">
                </div>

                <div class="col-12">
                  <label class="form-label">Notes</label>
                  <textarea name="notes" rows="4"
                            class="form-control @error('notes') is-invalid @enderror"
                            placeholder="Enter additional notes...">{{ old('notes', $buyer->notes) }}</textarea>
                  @error('notes')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                </div>
              </div>
            </div>

            {{-- Buyer Criteria --}}
            <div class="col-12 mt-8">
              <div class="d-flex align-items-center justify-content-between mb-12">
                <h6 class="mb-0">Criteria</h6>
                <button type="button" id="add-criteria" class="btn btn-outline-primary">
                  <iconify-icon icon="lucide:plus" class="me-6"></iconify-icon> Add Rule
                </button>
              </div>

              @php
                $existing = old(
                  'criteria',
                  $buyer->exists ? $buyer->criteria->toArray()
                                 : [['field'=>'','operator'=>'','value'=>'','weight'=>1]]
                );
              @endphp

              <div id="criteria-container" class="row gy-3">
                @foreach($existing as $i => $c)
                  <div class="criteria-row col-12">
                    <div class="card bg-neutral-50 border-0">
                      <div class="card-body">
                        <div class="row gy-3">
                          <div class="col-md-3">
                            <label class="form-label">Field</label>
                            <select name="criteria[{{ $i }}][field]"
                                    class="form-select @error('criteria.'.$i.'.field') is-invalid @enderror" required>
                              <option value="" disabled {{ $c['field']=='' ? 'selected' : '' }}>Select</option>
                              <option value="location"       @selected($c['field']=='location')>Location</option>
                              <option value="price"          @selected($c['field']=='price')>Price</option>
                              <option value="property_type"  @selected($c['field']=='property_type')>Property Type</option>
                              <option value="bedrooms"       @selected($c['field']=='bedrooms')>Bedrooms</option>
                              <option value="bathrooms"      @selected($c['field']=='bathrooms')>Bathrooms</option>
                              <option value="square_footage" @selected($c['field']=='square_footage')>Sq. Footage</option>
                            </select>
                            @error('criteria.'.$i.'.field') <div class="invalid-feedback">{{ $message }}</div> @enderror
                          </div>

                          <div class="col-md-2">
                            <label class="form-label">Operator</label>
                            <select name="criteria[{{ $i }}][operator]"
                                    class="form-select @error('criteria.'.$i.'.operator') is-invalid @enderror" required>
                              <option value="" disabled {{ $c['operator']=='' ? 'selected' : '' }}>Select</option>
                              <option value=">=" @selected($c['operator']=='>=')>≥</option>
                              <option value="<=" @selected($c['operator']=='<=')>≤</option>
                              <option value="="  @selected($c['operator']=='=')>=</option>
                              <option value="IN" @selected($c['operator']=='IN')>IN</option>
                            </select>
                            @error('criteria.'.$i.'.operator') <div class="invalid-feedback">{{ $message }}</div> @enderror
                          </div>

                          <div class="col-md-4">
                            <label class="form-label">Value</label>
                            <input type="text" name="criteria[{{ $i }}][value]"
                                   class="form-control @error('criteria.'.$i.'.value') is-invalid @enderror"
                                   value="{{ $c['value'] }}" placeholder="e.g. NYC or 500000" required>
                            @error('criteria.'.$i.'.value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                          </div>

                          <div class="col-md-2">
                            <label class="form-label">Weight</label>
                            <input type="number" name="criteria[{{ $i }}][weight]"
                                   class="form-control @error('criteria.'.$i.'.weight') is-invalid @enderror"
                                   min="1" max="10" value="{{ $c['weight'] ?? 1 }}" required>
                            @error('criteria.'.$i.'.weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                          </div>

                          <div class="col-md-1 d-flex align-items-end">
                            <button type="button"
                                    class="btn btn-danger-600 remove-criteria"
                                    title="Remove this rule">
                              <iconify-icon icon="radix-icons:trash" class="text-lg"></iconify-icon>
                            </button>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                @endforeach
              </div>
            </div>

            {{-- Actions --}}
            <div class="col-12 d-flex justify-content-end gap-2 mt-8">
              <a href="{{ route('admin.buyers.index') }}" class="btn btn-outline-secondary">Cancel</a>
              <button type="submit" class="btn btn-primary-600">
                <iconify-icon icon="lucide:save" class="me-6"></iconify-icon>
                {{ $buyer->exists ? 'Update Buyer' : 'Save Buyer' }}
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  (function () {
    let idx = {{ count($existing) }};

    // Add a new criteria block
    document.getElementById('add-criteria')?.addEventListener('click', function () {
      const container = document.getElementById('criteria-container');
      const firstRow = container.querySelector('.criteria-row');
      if (!firstRow) return;

      const clone = firstRow.cloneNode(true);

      // Reset values + update indices
      clone.querySelectorAll('select, input').forEach(function (el) {
        const oldName = el.getAttribute('name');
        if (oldName) el.setAttribute('name', oldName.replace(/\[\d+\]/, '[' + idx + ']'));
        if (el.tagName === 'SELECT') {
          el.selectedIndex = 0;
        } else {
          el.value = el.type === 'number' ? 1 : '';
        }
        el.classList.remove('is-invalid');
      });

      // Append and increment index
      container.appendChild(clone);
      idx++;
    });

    // Remove criteria (leave at least one)
    document.addEventListener('click', function (e) {
      if (!e.target.closest('.remove-criteria')) return;
      const container = document.getElementById('criteria-container');
      const rows = container.querySelectorAll('.criteria-row');
      if (rows.length > 1) {
        e.target.closest('.criteria-row').remove();
      }
    });
  })();
</script>
@endpush

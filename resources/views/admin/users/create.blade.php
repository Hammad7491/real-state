{{-- resources/views/admin/buyers/form.blade.php --}}
@extends('layouts.app')

@section('title', isset($buyer->id) ? 'Edit Buyer' : 'New Buyer')

@push('styles')
<style>
  .criteria-row { position: relative; }
  .criteria-row .remove-criteria {
    position: absolute;
    top: 0.5rem;
    right: 0.5rem;
  }
</style>
@endpush

@section('content')
<div class="page-content">
  <div class="row">
    <div class="col-xl-10 mx-auto mt-4">
      <div class="card shadow-sm mb-4">
        <div class="card-body p-4">
          <h4 class="card-title mb-4">
            <i class="bx bx-user-plus fs-3 text-primary me-2"></i>
            {{ isset($buyer->id) ? 'Edit Buyer' : 'New Buyer' }}
          </h4>

          <form method="POST"
                action="{{ isset($buyer->id)
                           ? route('admin.buyers.update', $buyer)
                           : route('admin.buyers.store') }}">
            @csrf
            @isset($buyer->id) @method('PUT') @endisset

            {{-- Buyer Info --}}
            <div class="row g-3 mb-4">
              <div class="col-md-6 form-floating">
                <input type="text" name="name" id="inputName"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $buyer->name ?? '') }}"
                       required>
                <label for="inputName">Name</label>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6 form-floating">
                <input type="email" name="email" id="inputEmail"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $buyer->email ?? '') }}"
                       required>
                <label for="inputEmail">Email</label>
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-md-6 form-floating">
                <input type="text" name="phone" id="inputPhone"
                       class="form-control @error('phone') is-invalid @enderror"
                       value="{{ old('phone', $buyer->phone ?? '') }}">
                <label for="inputPhone">Phone</label>
                @error('phone') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
              <div class="col-12 form-floating">
                <textarea name="notes" id="inputNotes"
                          class="form-control @error('notes') is-invalid @enderror"
                          style="height:100px">{{ old('notes', $buyer->notes ?? '') }}</textarea>
                <label for="inputNotes">Notes</label>
                @error('notes') <div class="invalid-feedback">{{ $message }}</div> @enderror
              </div>
            </div>

            {{-- Criteria --}}
            <h6 class="mb-3">Matching Criteria</h6>
            @php
              $existing = old('criteria',
                  isset($buyer)
                    ? $buyer->criteria->toArray()
                    : [['field'=>'','operator'=>'','value'=>'','weight'=>1]]
              );
            @endphp

            <div id="criteria-container">
              @foreach($existing as $i => $c)
                <div class="criteria-row row g-3 mb-3">
                  <div class="col-md-3 form-floating">
                    <select name="criteria[{{ $i }}][field]"
                            class="form-select @error('criteria.'.$i.'.field') is-invalid @enderror"
                            required>
                      <option value="" disabled {{ $c['field']==''?'selected':'' }}>Field</option>
                      <option value="location"       {{ $c['field']=='location'       ?'selected':'' }}>Location</option>
                      <option value="price"          {{ $c['field']=='price'          ?'selected':'' }}>Price</option>
                      <option value="property_type"  {{ $c['field']=='property_type'  ?'selected':'' }}>Property Type</option>
                      <option value="bedrooms"       {{ $c['field']=='bedrooms'       ?'selected':'' }}>Bedrooms</option>
                      <option value="bathrooms"      {{ $c['field']=='bathrooms'      ?'selected':'' }}>Bathrooms</option>
                      <option value="square_footage" {{ $c['field']=='square_footage' ?'selected':'' }}>Sq. Footage</option>
                    </select>
                    <label>Field</label>
                    @error('criteria.'.$i.'.field') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>

                  <div class="col-md-2 form-floating">
                    <select name="criteria[{{ $i }}][operator]"
                            class="form-select @error('criteria.'.$i.'.operator') is-invalid @enderror"
                            required>
                      <option value="" disabled {{ $c['operator']==''?'selected':'' }}>Op</option>
                      <option value=">=" {{ $c['operator']=='>='?'selected':'' }}>&ge;</option>
                      <option value="<=" {{ $c['operator']=='<='?'selected':'' }}>&le;</option>
                      <option value="="  {{ $c['operator']=='='?'selected':'' }}>=</option>
                      <option value="IN" {{ $c['operator']=='IN'?'selected':'' }}>IN</option>
                    </select>
                    <label>Operator</label>
                    @error('criteria.'.$i.'.operator') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>

                  <div class="col-md-4 form-floating">
                    <input type="text"
                           name="criteria[{{ $i }}][value]"
                           class="form-control @error('criteria.'.$i.'.value') is-invalid @enderror"
                           value="{{ $c['value'] }}"
                           required>
                    <label>Value</label>
                    @error('criteria.'.$i.'.value') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>

                  <div class="col-md-2 form-floating">
                    <input type="number"
                           name="criteria[{{ $i }}][weight]"
                           class="form-control @error('criteria.'.$i.'.weight') is-invalid @enderror"
                           min="1" max="10"
                           value="{{ $c['weight'] }}"
                           required>
                    <label>Weight</label>
                    @error('criteria.'.$i.'.weight') <div class="invalid-feedback">{{ $message }}</div> @enderror
                  </div>

                  <div class="col-md-1 d-flex align-items-center">
                    <button type="button" class="btn btn-outline-danger remove-criteria px-2">&times;</button>
                  </div>
                </div>
              @endforeach
            </div>

            <button type="button" id="add-criteria" class="btn btn-outline-secondary mb-4">
              + Add Another Rule
            </button>

            {{-- Submit --}}
            <div class="text-end">
              <button type="submit" class="btn btn-primary px-5">
                {{ isset($buyer->id) ? 'Update Buyer' : 'Save Buyer' }}
              </button>
              <a href="{{ route('admin.buyers.index') }}" class="btn btn-light ms-2">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(function(){
    // start idx at existing rows count
    let idx = {{ count($existing) }};

    $('#add-criteria').on('click', function(){
      // clone the first row
      const $clone = $('.criteria-row:first').clone();
      // reset inputs & bump index
      $clone.find('select, input').each(function(){
        const name = $(this).attr('name').replace(/\d+/, idx);
        $(this).attr('name', name).val('');
      });
      $('#criteria-container').append($clone);
      idx++;
    });

    // remove handler
    $(document).on('click', '.remove-criteria', function(){
      if ($('.criteria-row').length > 1) {
        $(this).closest('.criteria-row').remove();
      }
    });
  });
</script>
@endpush

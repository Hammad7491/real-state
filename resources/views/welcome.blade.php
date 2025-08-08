<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>{{ isset($seller) ? 'Edit Your Listing' : 'Sell Your Property' }}</title>

  <!-- Bootstrap 5 CSS -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
    rel="stylesheet"
  />

  <style>
    /* Hero styling */
    #hero {
      background: #0d6efd;
      color: white;
      padding: 4rem 0;
      text-align: center;
      position: relative;
    }
    #seller-form {
      padding: 3rem 0;
    }
    .creative-only {
      display: none;
    }
  </style>
</head>
<body>

  <!-- Hero Section -->
  <section id="hero">
    <div class="container">
      <a href="{{ route('login') }}"
         class="btn btn-outline-light position-absolute top-0 end-0 mt-4 me-3">
        Login
      </a>
      <h1 class="display-5 fw-bold">Landing Page</h1>
      <p class="lead">Tell us about your home and we’ll connect you with qualified buyers.</p>
    </div>
  </section>

  <!-- Seller Form Section -->
  <section id="seller-form">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-8">

          <div class="card shadow-sm">
            <div class="card-body p-4">
              <h2 class="h4 mb-4">
                {{ isset($seller) ? 'Edit Your Listing' : 'Your Property Details' }}
              </h2>

              <form method="POST"
                    action="{{ isset($seller)
                                ? route('sellers.update', $seller)
                                : route('sellers.store') }}">
                @csrf
                @isset($seller) @method('PUT') @endisset

                <div class="row g-3">
                  <!-- Basic Seller Info -->
                  <div class="col-md-6">
                    <label class="form-label">Your Name</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ old('name', $seller->name ?? '') }}" required>
                    @error('name') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Email Address</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email', $seller->email ?? '') }}" required>
                    @error('email') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Phone Number</label>
                    <input type="tel" name="phone" class="form-control"
                           value="{{ old('phone', $seller->phone ?? '') }}">
                    @error('phone') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>

                  <!-- Property Address -->
                  <div class="col-md-6">
                    <label class="form-label">Property Address</label>
                    <input type="text" name="property_address" class="form-control"
                           value="{{ old('property_address', $seller->property_address ?? '') }}"
                           required>
                    @error('property_address') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">City</label>
                    <input type="text" name="property_city" class="form-control"
                           value="{{ old('property_city', $seller->property_city ?? '') }}" required>
                    @error('property_city') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">State</label>
                    <input type="text" name="property_state" class="form-control"
                           value="{{ old('property_state', $seller->property_state ?? '') }}" required>
                    @error('property_state') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">ZIP Code</label>
                    <input type="text" name="property_zip" class="form-control"
                           value="{{ old('property_zip', $seller->property_zip ?? '') }}" required>
                    @error('property_zip') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>

                  <!-- Deal Type & Core Deal Fields -->
                  <div class="col-md-6">
                    <label class="form-label">Deal Type</label>
                    <select name="deal_type" class="form-select" required>
                      @foreach(['Cash','Subject-To','Seller-Finance','Hybrid'] as $d)
                      <option value="{{ $d }}"
                        {{ old('deal_type', $seller->deal_type ?? '') === $d ? 'selected' : '' }}>
                        {{ $d }}
                      </option>
                      @endforeach
                    </select>
                    @error('deal_type') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-md-6">
                    <label class="form-label">Asking Price</label>
                    <input type="number" name="asking_price" class="form-control"
                           value="{{ old('asking_price', $seller->asking_price ?? '') }}" required>
                    @error('asking_price') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>

                  <div class="col-md-4">
                    <label class="form-label">Bedrooms</label>
                    <input type="number" name="bedrooms" min="0" class="form-control"
                           value="{{ old('bedrooms', $seller->bedrooms ?? '') }}">
                    @error('bedrooms') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Bathrooms</label>
                    <input type="number" name="bathrooms" step="0.5" class="form-control"
                           value="{{ old('bathrooms', $seller->bathrooms ?? '') }}">
                    @error('bathrooms') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-md-4">
                    <label class="form-label">Square Footage</label>
                    <input type="number" name="square_footage" class="form-control"
                           value="{{ old('square_footage', $seller->square_footage ?? '') }}">
                    @error('square_footage') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>

                  <!-- ROI / Entry Inputs (always shown) -->
                  <div class="col-md-4 form-floating">
                    <input type="number" name="arv" class="form-control"
                           value="{{ old('arv', $seller->arv ?? '') }}" required>
                    <label>ARV (After Repair Value)</label>
                    @error('arv') <div class="text-danger">{{ $message }}</div> @enderror
                  </div>
                  <div class="col-md-4 form-floating">
                    <input type="number" name="estimated_repairs" class="form-control"
                           value="{{ old('estimated_repairs', $seller->estimated_repairs ?? '') }}">
                    <label>Estimated Repairs</label>
                  </div>
                  <div class="col-md-4 form-floating">
                    <input type="number" name="back_taxes" class="form-control"
                           value="{{ old('back_taxes', $seller->back_taxes ?? '') }}">
                    <label>Back Taxes</label>
                  </div>
                  <div class="col-md-4 form-floating">
                    <input type="number" name="title_liens" class="form-control"
                           value="{{ old('title_liens', $seller->title_liens ?? '') }}">
                    <label>Title Liens</label>
                  </div>
                  <div class="col-md-4 form-floating">
                    <input type="number" name="closing_costs" class="form-control"
                           value="{{ old('closing_costs', $seller->closing_costs ?? '') }}">
                    <label>Closing Costs</label>
                  </div>
                  <div class="col-md-4 form-floating">
                    <input type="number" name="transaction_coordinator_fees" class="form-control"
                           value="{{ old('transaction_coordinator_fees', $seller->transaction_coordinator_fees ?? '') }}">
                    <label>Coordinator Fees</label>
                  </div>

                  <!-- Creative-deal fields (hidden when Cash) -->
                  <div class="creative-only row g-3">
                    <div class="col-md-4 form-floating">
                      <input type="number" name="mortgage_balance" class="form-control"
                             value="{{ old('mortgage_balance', $seller->mortgage_balance ?? '') }}">
                      <label>Mortgage Balance</label>
                    </div>
                    <div class="col-md-4 form-floating">
                      <input type="number" name="monthly_piti" class="form-control"
                             value="{{ old('monthly_piti', $seller->monthly_piti ?? '') }}">
                      <label>Monthly PITI</label>
                    </div>
                    <div class="col-md-4 form-floating">
                      <input type="number" name="arrears" class="form-control"
                             value="{{ old('arrears', $seller->arrears ?? '') }}">
                      <label>Arrears</label>
                    </div>

                    <div class="col-md-4 form-floating">
                      <input type="number" name="cash_to_seller" class="form-control"
                             value="{{ old('cash_to_seller', $seller->cash_to_seller ?? '') }}">
                      <label>Cash to Seller</label>
                    </div>
                    <div class="col-md-4 form-floating">
                      <input type="number" name="down_payment" class="form-control"
                             value="{{ old('down_payment', $seller->down_payment ?? '') }}">
                      <label>Down Payment</label>
                    </div>
                    <div class="col-md-4 form-floating">
                      <input type="number" name="monthly_payment_to_seller" class="form-control"
                             value="{{ old('monthly_payment_to_seller', $seller->monthly_payment_to_seller ?? '') }}">
                      <label>Monthly Payment to Seller</label>
                    </div>

                    <div class="col-md-4 form-floating">
                      <input type="number" step="0.01" name="interest_rate" class="form-control"
                             value="{{ old('interest_rate', $seller->interest_rate ?? '') }}">
                      <label>Interest Rate (%)</label>
                    </div>
                    <div class="col-md-4 form-floating">
                      <input type="number" name="term_length" class="form-control"
                             value="{{ old('term_length', $seller->term_length ?? '') }}">
                      <label>Term Length</label>
                    </div>
                    <div class="col-md-4 form-check form-switch">
                      <input class="form-check-input" type="checkbox" id="balloon" name="balloon"
                             value="1" {{ old('balloon', $seller->balloon ?? false) ? 'checked' : '' }}>
                      <label class="form-check-label" for="balloon">Balloon?</label>
                      <div class="mt-2 form-floating" style="max-width:150px;">
                        <input type="number" name="balloon_years" class="form-control"
                               value="{{ old('balloon_years', $seller->balloon_years ?? '') }}">
                        <label>Balloon Years</label>
                      </div>
                    </div>
                  </div>

                  <!-- Additional Details -->
                  <div class="col-12">
                    <label class="form-label">Additional Details</label>
                    <textarea name="additional_details" class="form-control" rows="4"
                    >{{ old('additional_details', $seller->additional_details ?? '') }}</textarea>
                  </div>

                  <!-- Submit -->
                  <div class="col-12 text-center">
                    <button type="submit" class="btn btn-primary px-5">
                      {{ isset($seller) ? 'Update Seller' : 'Submit & Find Buyers' }}
                    </button>
                    <a href="{{ route('sellers.index') }}" class="btn btn-light ms-2">Cancel</a>
                  </div>
                </div>
              </form>

            </div><!-- /.card-body -->
          </div><!-- /.card -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section>

  <!-- Bootstrap 5 JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // show/hide creative inputs
    document.addEventListener('DOMContentLoaded', () => {
      const dealType = document.querySelector('select[name="deal_type"]');
      const creative = document.querySelectorAll('.creative-only');
      function toggle() {
        creative.forEach(el => el.style.display = dealType.value === 'Cash' ? 'none' : 'flex');
      }
      dealType.addEventListener('change', toggle);
      toggle();
    });
  </script>
</body>
</html>

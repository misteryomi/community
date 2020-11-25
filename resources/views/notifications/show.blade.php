@extends('layouts.app')
@section('header')

@endsection
@section('content')

    <div class="container mt-5">
        <h3 class="mb-0">Enquiry from #{{ $enquiry->user->username }}</h3>
        <a href="#"  data-toggle="modal" data-target="#modal-form" class="btn btn-warning mt-3">Create an Invoice</a>
      <div class="row mt-2">
        <div class="col-xl-12">
          <div class="card bg-secondary shadow">
            <div class="card-body">
              @include('layouts.notification')
              <div class="row">
                <div class="col-xl-12">
                    {{ $enquiry->enquiry }}
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>

<!-- Modal -->
<div class="card border-0">
        <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-body p-0">
                        <div class="card shadow border-0">

                            <div class="card-body">
                                <div class="text-center text-muted mb-4">
                                    <h3>Create Payment Invoice</h3>
                                    <!-- <p>Specify the Item and Price for each</p> -->
                                </div>
                                <form action="{{ route('invoice.post.new') }}" method="post" id="invoiceForm">
                                        @csrf
                                                <div id="pricingRows">
                                                    <div class="form-group row">
                                                        <div class="col-6">
                                                            <label>Item Description</label>
                                                            <input type="text" name="description[]" required class="form-control"/>
                                                        </div>
                                                        <div class="col-5">
                                                            <label>Price (in Naira)</label>
                                                            <input type="number" name="amount[]" required value="0" class="form-control price"/>
                                                        </div>
                                                    </div>

                                            </div>
                                            <a href="#" class="btn btn-sm btn-dark" id="addNew">Add a new item</a>
                                        <hr>
                                        <input type="hidden" name="payer_id" value="{{ $enquiry->user->id }}" />
                                        <h3>Total Price: NGN <span id="price">0</span></h3>
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-warning my-4">Generate Invoice</button>
                                        </div>
                                    </form>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>



@endsection

@section('script')
{{-- <script src="{{ asset('assets/vendor/dropzone/dropzone.js') }}"></script> --}}
<script>
  $(document).ready(function() {


    $('#addNew').click(function(e) {
        e.preventDefault();
        var newEl = `
                <div class="form-group row">
                    <div class="col-6">
                        <label>Item Description</label>
                        <input type="text" name="description[]" required class="form-control"/>
                    </div>
                    <div class="col-5">
                        <label>Price (in Naira)</label>
                        <input type="number" name="amount[]" required value="0" class="form-control price"/>
                    </div>
                    <div class="col-1 d-flex align-items-center mt-4">
                        <a href="#" class="remove"><i class="fa fa-times"></i></a>
                    </div>
                </div>
        
        `;
        $(newEl).appendTo('#pricingRows');
    })

    $('#pricingRows').on('keyup', '.price', function(e) {
        var pricesElement = $('#invoiceForm .price');
        // console.log(pricesElement);
        
        var totalPrice = 0;

        pricesElement.each((index, item) => {
            totalPrice += parseFloat(item.value);
        })

        console.log(totalPrice);
        $('#price').text(totalPrice);        
    });

    $('#pricingRows').on('click', '.remove', function(e) {
        $(this).parent().parent().remove(); ///.remove();
    });

  });
</script>
@endsection
@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="alert alert-success" id="success_msg" style="display: none">
            تم الحفظ بنجاح
        </div>

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    {{ trans('messages.AddYourOffer') }}
                </div>

                @if(Session::has('success'))
                    <div class="alert alert-success" role="alert">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <br>
                <form id="offerForm" method="POST" action="" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="photo" class="form-label">{{ trans('messages.PhotoField') }}</label>
                        <input type="file" class="form-control" id="photo" name="photo">
                        @error('photo')
                        <small id="emailHelp" class="form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name_ar" class="form-label">{{ trans('messages.OfferNameArInp') }}</label>
                        <input type="text" class="form-control" id="name_ar" name="name_ar">
                        @error('name_ar')
                        <small id="emailHelp" class="form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="name_en" class="form-label">{{ trans('messages.OfferNameEnInp') }}</label>
                        <input type="text" class="form-control" id="name_en" name="name_en">
                        @error('name_en')
                        <small id="emailHelp" class="form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="offerprice" class="form-label">{{ trans('messages.OfferPriceInp') }}</label>
                        <input type="text" class="form-control" id="offerprice" name="price">
                        @error('price')
                        <small id="emailHelp" class="form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="details_ar" class="form-label">{{ trans('messages.OfferDetailsArInp') }}</label>
                        <input type="text" class="form-control" id="details_ar" name="details_ar">
                        @error('details_ar')
                        <small id="emailHelp" class="form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="details_en" class="form-label">{{ trans('messages.OfferDetailsEnInp') }}</label>
                        <input type="text" class="form-control" id="details_en" name="details_en">
                        @error('details_en')
                        <small id="emailHelp" class="form-text text-muted">{{ $message }}</small>
                        @enderror
                    </div>
                    <button id="saveOffer" class="btn btn-primary">{{ trans('messages.SaveOfferBtn') }}</button>
                </form>



            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '#saveOffer', function (e){
            e.preventDefault();
            var formData = new FormData($('#offerForm')[0]);
            $.ajax({
                type: 'post',
                enctype: 'multipart/form-data',
                url: "{{ route('ajax.offers.store') }}",
                data: formData,
                processData: false,
                contentType: false,
                cache: false,
                success: function (data){
                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                },
                error: function (reject){

                }
            });
        });

    </script>
@endsection

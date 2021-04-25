@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="alert alert-success" id="success_msg" style="display: none">
            تم الحذف بنجاح
        </div>

        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ trans('messages.OfferNameTable') }}</th>
                <th scope="col">{{ trans('messages.OfferPriceTable') }}</th>
                <th scope="col">{{ trans('messages.OfferDetailsTable') }}</th>
                <th scope="col">Photo</th>
                <th scope="col">{{ trans('messages.Operations') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($offers as $offer)
                <tr class="offerRow{{$offer->id}}">
                    <th scope="row">{{ $offer->id }}</th>
                    <td>{{ $offer->name }}</td>
                    <td>{{ $offer->price }}</td>
                    <td>{{ $offer->details }}</td>
                    <td><img style="width: 30px;height:30px" src="{{ asset('images/offers/'.$offer->photo) }}"></td>
                    <td>
                        <a href="{{ url('offers/edit/'.$offer->id) }}" class="btn btn-success">{{ trans('messages.UpdateBtnTable') }}</a>
                        <a href="{{ route('offers.delete', $offer->id) }}" class="btn btn-danger">{{ trans('messages.DeleteBtnTable') }}</a>
                        <a offer_id="{{ $offer->id }}" class="deleteBtn btn btn-danger">حذف بالأجاكس</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).on('click', '.deleteBtn', function (e){
            e.preventDefault();
            var offer_id = $(this).attr('offer_id');
            $.ajax({
                type: 'post',
                url: "{{ route('ajax.offers.delete') }}",
                data: {
                    '_token' : "{{ csrf_token() }}",
                    'id' : offer_id
                },
                success: function (data){
                    if (data.status == true) {
                        $('#success_msg').show();
                    }
                    $('.offerRow'+data.id).remove();
                },
                error: function (reject){

                }
            });
        });

    </script>
@endsection

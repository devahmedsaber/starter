@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    المستشفيات
                </div>

                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                        <th scope="col">Address</th>
                        <th scope="col">الإجراءات</th>
                    </tr>
                    </thead>
                    <tbody>
                        @if(isset($hospitals) && $hospitals->count() > 0)
                            @foreach($hospitals as $hospital)
                                <tr>
                                    <th scope="row">{{ $hospital->id }}</th>
                                    <td>{{ $hospital->name }}</td>
                                    <td>{!! $hospital->address !!}</td>
                                    <td>
                                        <a href="{{ route('hospital.doctors', $hospital->id) }}" class="btn btn-success">عرض الأطباء</a>
                                        <a href="{{ route('hospital.delete', $hospital->id) }}" class="btn btn-danger">حذف</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection


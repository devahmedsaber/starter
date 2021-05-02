@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="flex-center position-ref full-height">
            <div class="content">
                <div class="title m-b-md">
                    خدمات الطبيب
                </div>

                <br>

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Name</th>
                    </tr>
                    </thead>
                    <tbody>

                    @if(isset($services) && $services->count() > 0)
                        @foreach($services as $service)
                            <tr>
                                <th scope="row">{{ $service->id }}</th>
                                <td>{{ $service->name }}</td>
                            </tr>
                        @endforeach
                    @endif

                    </tbody>
                </table>

                <form method="POST" action="{{ route('save.doctor.services') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="" class="form-label">أختر طبيب</label>
                        <select class="form-control" name="doctor_id">
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="" class="form-label">أختر الخدمات</label>
                        <select class="form-control" name="servicesIds[]" multiple>
                            @foreach($allServices as $allService)
                                <option value="{{ $allService->id }}">{{ $allService->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Save</button>
                </form>

            </div>
        </div>
    </div>
@endsection


@extends('layouts.default-container')

@push('scripts')
    <script>
        setTimeout(function(){
            window.location.replace('/');
        }, 3500);
    </script>
@endpush

@section('content')

    <div>

        <h4>
            You have successfully finished your order. You will now be returned to the homepage...
        </h4>

    </div>

@endsection
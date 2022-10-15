@extends('admin.layout')

@section('content')
    @foreach( $contacts as $contact)
    <div class="card mb-4">

        <div class="card-header d-flex justify-content-between pb-0">
            <h6 class="d-inline-block">{{ $contact->name }}</h6><small>{{ $contact->created_at->toJalali()->format('Y/n/j H:i') }}</small>
            <a class="btn bg-gradient-danger mb-0 d-inline-block" href="{{ route('admin.connect-us-delete' , $contact->id) }}"><i class="fas fas-remove" aria-hidden="true"></i>&nbsp;&nbsp;حذف پیام</a>
        </div>

        <div class="card-body px-0 pt-0 pb-2">
            @if($contact->number)
            <h7 class="d-inline-block"><a href="tel:{{ $contact->number  }}"> <i class="fas fa-phone"></i> {{ $contact->number  }}</a></h7>
            @endif
            @if($contact->email)
                <h7 class="d-inline-block"><a href="mailto:{{ $contact->email  }}"> <i class="fas fa-envelope"></i> {{ $contact->email  }}</a></h7>
            @endif
                <hr class="horizontal dark mb-0">
            <p class="p-3">
                {!! nl2br(strip_tags($contact->message)) !!}
            </p>
        </div>
    </div>
    @endforeach

    @if($contacts->hasPages())
    <div class="card mb-4">
        <div class="card-body px-0 pt-0 pb-2">
            <div class="p-3">
                {!! $contacts->links() !!}
            </div>
        </div>
    </div>
    @endif
@endsection

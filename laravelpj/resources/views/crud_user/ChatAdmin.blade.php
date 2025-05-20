@extends('dashboard')

@section('content')
<h3>📩 Tin nhắn từ khách hàng</h3>

@foreach($messages as $msg)
    <div class="card my-3">
        <div class="card-body">
            <strong>{{ $msg->customer->name ?? 'Ẩn danh' }}:</strong>
            <p>{{ $msg->message }}</p>
            <small>{{ $msg->created_at->format('d/m/Y H:i') }}</small>

            @if(!$msg->user_id)
            <form method="POST" action="{{ route('chatadmin.reply') }}" class="mt-2">
                @csrf
                <input type="hidden" name="customer_id" value="{{ $msg->customer_id }}">
                <textarea name="message" class="form-control" rows="2" placeholder="Phản hồi..."></textarea>
                <button class="btn btn-primary btn-sm mt-2">Gửi</button>
            </form>
            @else
                <p class="text-success mt-2">
                    <strong>Admin ({{ $msg->user->name }}):</strong> {{ $msg->message }}
                </p>
            @endif
        </div>
    </div>
@endforeach
@endsection

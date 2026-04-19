@extends('layouts.admin')

@section('title', 'View Message')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-xl shadow-sm p-6">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Message Details</h1>
        <div class="space-x-2">
            @if(!$contact->is_read)
            <form action="{{ route('admin.contacts.read', $contact) }}" method="POST" class="inline">
                @csrf
                @method('PATCH')
                <button class="text-sm bg-blue-100 text-blue-700 px-3 py-1 rounded">Mark as Read</button>
            </form>
            @endif
            <a href="{{ route('admin.contacts.index') }}" class="text-sm border px-3 py-1 rounded">Back</a>
        </div>
    </div>
    <div class="space-y-4">
        <div><span class="font-medium">From:</span> {{ $contact->name }} ({{ $contact->email }})</div>
        <div><span class="font-medium">Subject:</span> {{ $contact->subject }}</div>
        <div><span class="font-medium">Date:</span> {{ $contact->created_at->format('d M Y H:i') }}</div>
        <div class="border-t pt-4">
            <p class="whitespace-pre-line">{{ $contact->message }}</p>
        </div>
    </div>
</div>
@endsection
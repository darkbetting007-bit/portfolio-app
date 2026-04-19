@extends('layouts.admin')

@section('title', 'Messages')

@section('content')
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="p-6 border-b">
        <h1 class="text-xl font-bold">Contact Messages</h1>
    </div>
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Name</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Subject</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Status</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($contacts as $contact)
                <tr class="{{ $contact->is_read ? '' : 'bg-blue-50' }}">
                    <td class="px-6 py-4 whitespace-nowrap">{{ $contact->name }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ $contact->email }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">{{ Str::limit($contact->subject, 30) }}</td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $contact->created_at->format('d M Y') }}</td>
                    <td class="px-6 py-4 whitespace-nowrap">
                        <span class="px-2 py-1 text-xs rounded-full {{ $contact->is_read ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $contact->is_read ? 'Read' : 'Unread' }}
                        </span>
                    </td>
                    <td class="px-6 py-4 whitespace-nowrap text-sm">
                        <a href="{{ route('admin.contacts.show', $contact) }}" class="text-blue-600 hover:text-blue-900">View</a>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="px-6 py-10 text-center text-gray-500">No messages.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="p-4">
        {{ $contacts->links() }}
    </div>
</div>
@endsection
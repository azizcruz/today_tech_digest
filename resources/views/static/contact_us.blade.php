@extends('layouts.guest')

@section('title')
    Contact
@endsection

@section('main')
    <div>
        <h2 class="text-lg font-bold mb-4">Contact</h2>
        <p class="mb-4">
            If you have any questions or comments, please feel free to get in
            touch with us using the contact details below:
        </p>
        <ul class="list-disc ml-8 mb-4">
            <p>
                Email:<a href="mailto:info@example.com" class="ml-2 hover:underline">info@example.com</a>
            </p>
        </ul>
        <p class="mb-4">We look forward to hearing from you!</p>
    </div>
@endsection

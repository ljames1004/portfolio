@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-dark-bg" style="width: -webkit-fill-available;">
    @include('layouts.common.header')

    <!-- Main Content -->
    <main class="ml-20">
        <section id="contact" class="min-h-screen px-8 lg:px-16 py-20 animate-slide-up" style="height: 95vh">
            <div class="max-w-6xl mx-auto space-y-20">
                <h2 class="text-3xl toggle-text mb-6">Contact me</h2>

                <div class="mb-6">
                    <label for="email" class="toggle-text text-lg">Your email <span class="text-red-500">*</span></label>
                    <input type="email" id="email" class="block w-full border-b-2 border-green-500 bg-transparent p-2 toggle-text focus:outline-none focus:ring-0 placeholder-gray-500" placeholder="Enter your email" required>
                </div>

                <!-- Message Input -->
                <div>
                    <label for="message" class="toggle-text text-lg">Message</label>
                    <textarea id="message" class="block w-full border-b-2 border-green-500 bg-transparent p-2 toggle-text focus:outline-none focus:ring-0 placeholder-gray-500" placeholder="Your message"></textarea>
                </div>

                <div class="mt-12">
                    <button type="submit" class="text-accent-green text-lg font-semibold hover:underline">Submit</button>
                </div>
            </div>
        </section>
    </main>
</div>
@endsection

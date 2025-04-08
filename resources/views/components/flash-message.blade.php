@if(session()->has('message'))
    <div x-data="{ show: true }" x-init="setTimeout(() => show = false, 3000)" x-show="show"
         class="fixed top-5 left-1/2 transform -translate-x-1/2 bg-laravel text-white px-6 py-3 rounded-lg shadow-lg">
        <p class="text-center">
            {{ session('message') }}
        </p>
    </div>
@endif

<x-layout>
    <x-slot:title>
        Home Feed
    </x-slot:title>

    @if($errors->any())
        {{-- {{ dd($errors->all()) }} --}}

        <div class="alert alert-error mb-4">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

<div class="max-w-2xl mx-auto">
        <h1 class="text-3xl font-bold mt-8">Latest Chirps</h1>
        
        <!-- Chirp Form -->
        <div class="card bg-base-100 shadow mb-8 mt-8 ">
            <div class="card-body">

                <form method="POST" action="/chirps">
                    @csrf
                    <div class="form-control w-full">
                        <textarea
                            name="message"
                            placeholder="What's on your mind?"
                            class="textarea textarea-bordered w-full resize-none @error('message') textarea-error @enderror"
                            rows="4"
                            maxlength="255"
                            required
                        >{{ old('message') }}</textarea>

                        @error('message')
                            <div class="label">
                                <span class="label-text-alt text-error">{{ $message }}</span>
                            </div>
                        @enderror
                    </div>

                    <div class="mt-4 flex items-center justify-end">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Chirp
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="max-w-2xl mx-auto">
            @forelse ($chirps as $chirp)
                <x-chirp :chirp="$chirp" class="mb-4" />
            @empty
                <p class="text-gray-500">No chirps yet. Be the first to chirp!</p>
            @endforelse
        </div>

    </div>

</x-layout>
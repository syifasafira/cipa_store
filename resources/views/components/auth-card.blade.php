<div {!! $attributes->merge(['class' => 'min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-slate-50']) !!}>
    <div class="w-full sm:max-w-md mt-6 px-6 py-8 bg-white shadow-lg overflow-hidden sm:rounded-2xl border border-gray-100">
        {{ $slot }}
    </div>
</div>

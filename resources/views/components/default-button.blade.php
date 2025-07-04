<button {{ $attributes->merge([
    'class' => 'inline-flex items-center px-4 py-2 bg-blue-100 border border-blue-400 rounded-md font-semibold text-xs text-blue-800 uppercase tracking-widest shadow-sm hover:bg-blue-200 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150'
]) }}>
    {{ $slot }}
</button>
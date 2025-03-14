<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center py-2 border border-transparent rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest bg-[#D97706] hover:bg-[#ff9d00] focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 w-full justify-center']) }}>
    {{ $slot }}
</button>

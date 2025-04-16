<div class="relative w-auto h-auto" x-data>
    <template x-teleport="body">
        <div 
            x-data="{
                show: false,
                message: '',
                type: 'success'
            }"
            x-init="
                @if(session()->has('success'))
                    show = true;
                    message = '{{ session('success') }}';
                    type = 'success';
                    setTimeout(() => show = false, 4000);
                @elseif(session()->has('error'))
                    show = true;
                    message = '{{ session('error') }}';
                    type = 'danger';
                    setTimeout(() => show = false, 4000);
                @elseif(session()->has('warning'))
                    show = true;
                    message = '{{ session('warning') }}';
                    type = 'warning';
                    setTimeout(() => show = false, 4000);
                @elseif(session()->has('info'))
                    show = true;
                    message = '{{ session('info') }}';
                    type = 'info';
                    setTimeout(() => show = false, 4000);
                @endif
            "
            x-show="show"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 translate-y-4"
            x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 translate-y-4"
            class="z-[9999] max-w-[640px] translate-x-[100%] absolute inset-x-0 top-4 px-4"
        >
            <div 
                class="flex items-center px-4 py-3 rounded-lg shadow-lg"
                :class="{
                    'bg-green-500 text-white': type === 'success',
                    'bg-red-500 text-white': type === 'danger',
                    'bg-yellow-500 text-gray-800': type === 'warning',
                    'bg-blue-500 text-white': type === 'info'
                }"
            >
                <template x-if="type === 'success'">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                </template>
                <template x-if="type === 'danger'">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </template>
                <template x-if="type === 'warning'">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                    </svg>
                </template>
                <template x-if="type === 'info'">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </template>
                
                <span x-text="message" class="text-sm font-medium"></span>
            </div>
        </div>
    </template>
</div>
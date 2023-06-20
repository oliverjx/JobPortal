<header class="text-gray-600 body-font border-b border-gray-100">
    <div class="container mx-auto flex flex-wrap p-5 flex-col md:flex-row items-center">
        <a href="<?php echo e(route('listings.index')); ?>" class="flex title-font font-medium items-center text-gray-900 mb-4 md:mb-0">
            <img src="<?php echo e(asset('img/jobessentials_logo.png')); ?>"></a>
            <span class="ml-3 text-xl">JobEssentials</span>
        </a>
        <nav class="md:ml-auto flex flex-wrap items-center text-base justify-center">
            <a href="<?php echo e(route('login')); ?>" class="mr-5 hover:text-gray-900">Mis ofertas</a>
        </nav>
        <a href="<?php echo e(route('listings.create')); ?>" class="inline-flex items-center bg-indigo-500 text-white border-0 py-1 px-3 focus:outline-none hover:bg-indigo-600 rounded text-base mt-4 md:mt-0">Publicar trabajos
            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 ml-1" viewBox="0 0 24 24">
                <path d="M5 12h14M12 5l7 7-7 7"></path>
            </svg>
        </a>
    </div>
</header><?php /**PATH C:\xampp1\htdocs\JobPortal\resources\views/components/header.blade.php ENDPATH**/ ?>
<?php
include APP_DIR.'views/templates/header.php';
?>
<?php
include APP_DIR.'views/templates/sidenav.php';
?>
<main class="flex-1 overflow-y-auto p-8 ml-64">

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Our Services</h1>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach($services as $service): ?>
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <h2 class="text-xl font-semibold text-gray-800"><?=$service['name']?></h2>
            </div>
            <p class="text-gray-600 mb-4"><?= $service['description'] ?></p>
            <div class="flex items-center text-gray-700 mb-2">
                <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Duration: <?=$service['duration']?> minutes
            </div>
            <div class="flex items-center text-gray-700">
                <svg class="h-5 w-5 mr-2 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Price: ₱<?=$service['duration']?>
            </div>
            <div class="flex justify-end mt-4">
                <a href="<?=site_url('patient/appointments')?>">
                <button class="px-6 py-2 bg-blue-500 text-white font-semibold rounded-full shadow-md hover:bg-blue-600 hover:shadow-lg transition-all duration-300">
                    Book Now
                </button>
                </a>

            </div>
        </div>
        <?php endforeach; ?>

    </div>
</div>
<?php
include APP_DIR.'views/templates/footer.php';
?>

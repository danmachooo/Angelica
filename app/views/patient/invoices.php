<?php
include APP_DIR.'views/templates/header.php';
?>
<?php
include APP_DIR.'views/templates/sidenav.php';
?>
<main class="flex-1 overflow-y-auto p-8 ml-64">

<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-6">Invoices</h1>
    
    <div class="space-y-6">
        <!-- START INVOICE CARD -->
        <?php foreach($invoices as $invoice):?>
        <div class="bg-white rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow duration-300">
            <div class="flex justify-between items-start mb-4">
                <div>
                    <h2 class="text-xl font-semibold text-gray-800">Invoice #<?= $invoice['invoice_id']?></h2>
                    <p class="text-gray-600"><?= $invoice['firstname']?> <?= $invoice['lastname']?></p>
                </div>
            </div>
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <p class="text-sm text-gray-600">Appointment Date</p>
                    <p class="font-medium"><?= $invoice['issue_date']?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Service</p>
                    <p class="font-medium"><?= $invoice['service_name']?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Price</p>
                    <p class="font-medium">$<?= number_format($invoice['service_price'], 2)?></p>
                </div>
                <div>
                    <p class="text-sm text-gray-600">Invoice Date</p>
                    <p class="font-medium"><?= $invoice['issue_date']?></p>
                </div>
            </div>
            <div class="flex justify-end">
                <button class="view-details-btn text-blue-600 hover:text-blue-800 font-medium flex items-center" data-invoice-id="<?= $invoice['invoice_id']?>">
                    <svg class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    View Details
                </button>
            </div>
        </div>   
        <?php endforeach; ?>
        <!-- END INVOICE CARD -->
     
    </div>
</div>

<!-- Modal -->
<div id="invoiceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg leading-6 font-medium text-gray-900 mb-2" id="modalTitle"></h3>
            <div class="mt-2 px-7 py-3">
                <div class="grid grid-cols-2 gap-4" id="modalContent">
                    <!-- Modal content will be dynamically inserted here -->
                </div>
            </div>
            <div class="items-center px-4 py-3">
                <button id="closeModal" class="px-4 py-2 bg-blue-500 text-white text-base font-medium rounded-md w-full shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-300">
                    Close
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        const modal = $('#invoiceModal');
        const modalTitle = $('#modalTitle');
        const modalContent = $('#modalContent');
        const closeModal = $('#closeModal');
        const viewDetailsBtns = $('.view-details-btn');

        viewDetailsBtns.on('click', function() {
            const invoiceId = $(this).data('invoice-id');
            console.log('Invoice ID: ', invoiceId);
            $.ajax({
                url: `<?= site_url('patient/invoices/') ?>${invoiceId}`, // Changed this line
                method: 'GET',
                dataType: 'json',
                success: function(response) {
                    const invoice = response.invoice; // Changed this line
                    modalTitle.text(`Invoice #${invoice.invoice_id} - ${invoice.firstname} ${invoice.lastname}`);
                    console.log(invoice);
                    modalContent.html(`
                        <div>
                            <p class="text-sm text-gray-600">Appointment Date</p>
                            <p class="font-medium">${invoice.issue_date}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Service</p>
                            <p class="font-medium">${invoice.service_name}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Price</p>
                            <p class="font-medium">$${parseFloat(invoice.service_price).toFixed(2)}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-600">Invoice Date</p>
                            <p class="font-medium">${invoice.issue_date}</p>
                        </div>
                    `);
                    
                    modal.removeClass('hidden');
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('Error fetching invoice details:', textStatus, errorThrown);
                    console.log('Response:', jqXHR.responseText); // Add this line for debugging
                    alert('Failed to load invoice details. Please try again.');
                }
            });
        });

        closeModal.on('click', function() {
            modal.addClass('hidden');
        });

        $(window).on('click', function(event) {
            if (event.target === modal[0]) {
                modal.addClass('hidden');
            }
        });
    });
</script>

<?php
include APP_DIR.'views/templates/footer.php';
?>

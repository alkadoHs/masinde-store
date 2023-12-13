<?php include APPPATH . "/views/includes/header.php" ?>
<?php include APPPATH . "/views/includes/sidebar.php" ?>

<main class="py-4 px-2 lg:px-4 md:ml-64 h-auto pt-20 ">
    <?php if ($this->session->flashdata('sales_confirmed')): ?>
        <div id="toast-success"
            class="flex items-center w-full p-4 mb-4 text-gray-500 bg-white rounded-lg shadow dark:text-gray-400 dark:bg-gray-800"
            role="alert">
            <div
                class="inline-flex items-center justify-center flex-shrink-0 w-8 h-8 text-green-500 bg-green-100 rounded-lg dark:bg-green-800 dark:text-green-200">
                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                    viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm3.707 8.207-4 4a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 1.414-1.414L9 10.586l3.293-3.293a1 1 0 0 1 1.414 1.414Z" />
                </svg>
                <span class="sr-only">Check icon</span>
            </div>
            <div class="ml-3 text-sm font-normal">
                <?= $this->session->flashdata('sales_confirmed') ?>
            </div>
            <button type="button"
                class="ml-auto -mx-1.5 -my-1.5 bg-white text-gray-400 hover:text-gray-900 rounded-lg focus:ring-2 focus:ring-gray-300 p-1.5 hover:bg-gray-100 inline-flex items-center justify-center h-8 w-8 dark:text-gray-500 dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700"
                data-dismiss-target="#toast-success" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>
    <?php elseif ($this->session->flashdata('exceed_stock2')): ?>
        <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800"
            role="alert">
            <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div>
                <?= $this->session->flashdata('exceed_stock2') ?>
            </div>
        </div>
    <?php endif ?>


    <section class="bg-gray-50 dark:bg-gray-900 h-screen flex items-start">
        <div class="max-w-screen-xl mx-auto lg:px-12 w-full">
            <!-- Start coding here -->



            <section class="bg-gray-50 dark:bg-gray-900 py-3">
                <div class="mx-auto max-w-screen-xl lg:px-4">
                    <!-- Start coding here -->
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <h2 class="text-2xl text-gray-700 font-semibold">Vendor Data</h2>
                        <p class="text-gray-400">Track what your vendors are doing here!</p>
                        <div class="overflow-x-auto">
                            <table id="example" class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th style="font-weight: 400; font-size: small">VENDOR</th>
                                        <th style="font-weight: 400; font-size: small">FROM BRANCH</th>
                                        <th style="font-weight: 400; font-size: small">PRODUCT NAME</th>
                                        <th style="font-weight: 400; font-size: small">QUANTITY</th>
                                        <th style="font-weight: 400; font-size: small">REMAINED</th>
                                        <th style="font-weight: 400; font-size: small">DATE</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $totalPrice = 0; ?>
                                    <?php $orderId = null; ?>
                                    <?php foreach ($orderitems as $orderitem): ?>
                                        <tr class="border-b dark:border-gray-700">
                                            <td>
                                                <?= $orderitem->vendor ?>
                                            </td>
                                            <td>
                                                <?= $orderitem->branch ?>
                                            </td>
                                            <th scope="row"
                                                class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                                <?= $orderitem->name ?>
                                            </th>
                                            <td class="px-4 py-3">
                                                <?= $orderitem->quantity ?>
                                            </td>
                                            <td>
                                                <?= $orderitem->inventory ?>
                                            </td>
                                            <td>
                                                <?= format_date_time($orderitem->createdAt) ?>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
    </section>
</main>
</div>


<!-- <script>
    $(document).ready(function () {
        $('#updateButton').on('click', function () {
            var formData = $('#productTable :input').serializeArray();
            console.log('Data to be sent:', formData);
            $.ajax({
                url: "<? //= site_url('vendorProduct/update') ?>",
                type: 'POST',
                data: formData,
                success: function (response) {
                    location.reload();
                    console.log('Data updated successfully:', response);
                },
                error: function (error) {
                    console.error('Error updating data:', error);
                }
            });
        });
    });

</script> -->

<?php include APPPATH . "/views/includes/footer.php" ?>
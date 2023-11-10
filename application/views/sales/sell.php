  <?php include APPPATH . "/views/includes/header.php"?>
  <?php include APPPATH . "/views/includes/sidebar.php"?>

  <main class="py-4 px-2 lg:px-4 md:ml-64 h-auto pt-20 ">
    <section class="bg-gray-50 dark:bg-gray-900">
                <!-- ALERTS -->
        <div class="mx-auto max-w-screen-xl lg:px-6">
        <?php if($this->session->flashdata('exceed_stock')): ?>
             <div class="flex items-center p-4 mb-4 text-sm text-red-800 border border-red-300 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 dark:border-red-800" role="alert">
                <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                </svg>
                <span class="sr-only">Info</span>
                <div>
                    <span class="font-medium">Fail!</span> <?= $this->session->flashdata('exceed_stock') ?>
                </div>
             </div> 
        <?php endif; ?>
         <h2 class="text-2xl font-bold text-slate-100 my-3">Sell Products</h2>
         <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
            <div class="w-full md:w-1/2">
                <form class="flex items-center">
                    <!-- <label for="simple-search" class="sr-only">Search</label>
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <input type="text" readonly  id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-500 focus:border-sky-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-500 dark:focus:border-sky-500" placeholder="Search" required="">
                    </div> -->
                </form>
            </div>
            <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                <button id="updateButton" type="button" class="flex items-center justify-center text-white bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-sky-600 dark:hover:bg-sky-700 focus:outline-none dark:focus:ring-sky-800">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.023 9.348h4.992v-.001M2.985 19.644v-4.992m0 0h4.992m-4.993 0l3.181 3.183a8.25 8.25 0 0013.803-3.7M4.031 9.865a8.25 8.25 0 0113.803-3.7l3.181 3.182m0-4.991v4.99" />
                    </svg>
                    Calculate Price
                </button>
            </div>
        </div>
        <div class="overflow-auto">
            <table id="updateTable" class="border-collapse border border-slate-400 w-full rounded my-4">
                <thead>
                    <tr>
                    <th class="text-orange-500 text-start p-4">PRODUCT</th>
                    <th class="text-orange-500 text-start p-4">PRICE</th>
                    <th class="text-orange-500 text-start p-4">QUANTITY</th>
                    <th class="text-orange-500 text-start p-4">TOTAL</th>
                    <th class="text-orange-500 text-start p-4">CANCEL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $overAllPrice = 0?>
                    <?php $cartId = null ?>
                    <?php foreach($cartItems as $item): ?>
                        <tr class="border border-slate-600">
                            <td class="text-slate-300 p-3"><?= $item->name ?></td>
                            <td class="text-slate-300 p-3"><?= format_price($item->price) ?></td>
                            <?php $cartId = $item->cartId?>
                            <td class="px-4 py-3">
                                <input type="hidden" name="item_id[]" value="<?= $item->id ?>">
                                <input type="number" name="quantity[]" value="<?= $item->quantity ?>" id="quantity" class="bg-gray-50 border max-w-[100px] min-w-[80px] border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                            </td>
                            <?php $overAllPrice += ($item->price * $item->quantity) ?>
                            <td class="text-slate-300 p-3"><?= format_price($item->price * $item->quantity) ?></td>
                            <td class="px-4 py-3 flex items-center justify-end">
                                <a href="<?= site_url('sell/cancel_item/'.$item->id) ?>" type="button" class="text-red-700 border border-red-700 hover:bg-red-700 hover:text-white focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:border-red-500 dark:text-red-500 dark:hover:text-white dark:focus:ring-red-800 dark:hover:bg-red-500">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    <span class="sr-only">cancel cart item</span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
        <div class="w-full flex justify-center mb-10">
            <ul class="flex flex-col gap-3">
                <li class="flex gap-5">
                    <div class="text-white text-xl">Over All Price: </div>
                    <div class="text-xl font-bold text-green-400"><?= number_format($overAllPrice) ?></div>
                </li>
               
                <li class="grid grid-cols-2 gap-2">
                    <?php if($overAllPrice == 0):?>
                        <button disabled data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white bg-blue-700/50 hover:bg-blue-800/60 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        SELL PRODUCT
                        </button>
                    <?php else: ?>
                        <button data-modal-target="authentication-modal" data-modal-toggle="authentication-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" type="button">
                        SELL PRODUCT
                        </button>
                    <?php endif ?>

                    <!-- Main modal -->
                    <div id="authentication-modal" tabindex="-1" aria-hidden="true" class="fixed top-0 left-0 right-0 z-50 hidden w-full p-4 overflow-x-hidden overflow-y-auto md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative w-full max-w-md max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ml-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="authentication-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                                <div class="px-6 py-6 lg:px-8">
                                    <h3 class="mb-4 text-xl font-medium text-gray-900 dark:text-white">Payment Details</h3>
                                    <?php echo form_open('sell/complete_order', ["class"=>"space-y-6"]) ?>
                                    <input type="hidden" name="cartId" value="<?= $cartId ?>">
                                        <div>
                                            <label for="total" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Total price</label>
                                            <input type="total" name="total" value="<?= $overAllPrice ?>" id="total" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
                                        </div>
                                        <div>
                                            <label for="paid" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Amount paid</label>
                                            <input type="paid" value="<?= $overAllPrice ?>" name="paid" id="paid" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white"  required>
                                        </div>
                                        <div>
                                            <label for="default" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cash/Credit</label>
                                                <select id="default" name="paymentMethod" class="bg-gray-50 border border-gray-300 text-gray-900 mb-6 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option value="CASH">CASH</option>
                                                    <option value="CREDIT">CREDIT</option>
                                            </select>
                                        </div>

                                        <div>
                                        <label for="default" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select Customer</label>
                                        <select name="customerId" class="select2" style="width: 100%" id="select2">
                                                <option value="none">---none---</option>
                                                <?php foreach($customers as $customer): ?>
                                                    <option value="<?= $customer->id ?>"><?= $customer->name ?></option>
                                                <?php endforeach ?>
                                        </select>
                                        </div>
                                
                                        <button type="submit" class="w-full text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Sell</button>
                                    <?php echo form_close() ?>
                                </div>
                            </div>
                        </div>
                    </div> 

                </li>
            </ul>
        </div>


       <table id="example" class="display text-slate-200" style="width:100%">
        <thead>
            <tr>
                <th>S/N</th>
                <th>PRODUCT NAME</th>
                <th>BRAND</th>
                <th>STOCK</th>
                <th>RETAIL PRICE</th>
                <th>WHOLE PRICE</th>
            </tr>
        </thead>
        <tbody>
            <?php $rowId = 1?>
            <?php foreach($products as $product): ?>
            <tr>
                <td><?= $rowId < 10 ? "0".$rowId++ : $rowId++ ?></td>
                <td><?= $product->productName?></td>
                <td><?= $product->brand ? $product->brand : '--//--' ?></td>
                <td class="flex gap-2 items-center">
                    <?php if($product->inventory <= $product->stockLimit ):?>
                        <div class="inline-block w-4 h-4 mr-2 bg-red-700 rounded-full"></div>
                        <?php else: ?>
                        <div class="inline-block w-4 h-4 mr-2 bg-green-700 rounded-full"></div>
                        <?php endif; ?>
                    <?= number_format( $product->inventory) ?>
                </td>
                <td><a href="sell/create_cart/<?= $product->id ?>/<?= $product->retailPrice ?>" class="border border-green-300 p-1" href="google.com"><?= number_format($product->retailPrice) ?></a></td>
                <td><a href="sell/create_cart/<?= $product->id ?>/<?= $product->wholePrice ?>" class="border border-green-300 p-1" href="afyasoft.vercel.app"><?= number_format($product->wholePrice) ?></href=></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    </section>
  </main>
  </div>

  <script>
    $(document).ready(function() {
   $('#updateButton').on('click', function() {
      var formData = $('#updateTable :input').serializeArray();
      console.log('Data to be sent:', formData);
      $.ajax({
         url: 'sell/update_cart/',
         type: 'POST',
         data: formData,
         success: function(response) {
            location.reload();
            console.log('Data updated successfully:', response);
         },
         error: function(error) {
            console.error('Error updating data:', error);
         }
      });
   });
});
</script>
  <?php include APPPATH . "/views/includes/footer.php"?>
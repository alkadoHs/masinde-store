  <?php include APPPATH . "/views/includes/header.php"?>
  <?php include APPPATH . "/views/includes/sidebar.php"?>

  <?php $totalProducts = 0 ?>
  <?php foreach ($products as $product) {
         $totalProducts += $product->quantity;
     
  }?>

  <main class="p-4 md:ml-64 h-auto pt-20 ">
    <section class="bg-gray-50 dark:bg-gray-900">

    <h2 class="text-slate-200 text-xl my-3" >Hello <span class="text-sky-400 font-bold"><?= $username ?></span></h2>
        
        <div class="grid grid-cols-1 gap-4 sm:grid-cols-4">
            <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                <div class="p-4 bg-green-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L2.25 7.5 12 2.25l9.75 5.25-4.179 2.25m0 0L21.75 12l-4.179 2.25m0 0l4.179 2.25L12 21.75 2.25 16.5l4.179-2.25m11.142 0l-5.571 3-5.571-3" />
                    </svg>
                </div>
                <div class="px-4 text-gray-700">
                    <h3 class="text-sm tracking-wider">Products Sold</h3>
                    <p class="text-3xl"><?= number_format($totalProducts) ?></p>
                </div>
            </div>
            <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                <div class="p-4 bg-blue-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7v8a2 2 0 002 2h6M8 7V5a2 2 0 012-2h4.586a1 1 0 01.707.293l4.414 4.414a1 1 0 01.293.707V15a2 2 0 01-2 2h-2M8 7H6a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2v-2">
                        </path>
                    </svg></div>
                <div class="px-4 text-gray-700">
                    <h3 class="text-sm tracking-wider">Income Raised</h3>
                    <p class="text-3xl"><?= format_price($income) ?></p>
                </div>
            </div>
            <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                <div class="p-4 bg-indigo-400">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-white">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 002.25-2.25V6.75A2.25 2.25 0 0019.5 4.5h-15a2.25 2.25 0 00-2.25 2.25v10.5A2.25 2.25 0 004.5 19.5zm6-10.125a1.875 1.875 0 11-3.75 0 1.875 1.875 0 013.75 0zm1.294 6.336a6.721 6.721 0 01-3.17.789 6.721 6.721 0 01-3.168-.789 3.376 3.376 0 016.338 0z" />
                    </svg>
                </div>
                <div class="px-4 text-gray-700">
                    <h3 class="text-sm tracking-wider">Expenses</h3>
                    <p class="text-3xl"><?= format_price($expenses) ?></p>
                </div>
            </div>
            <div class="flex items-center bg-white border rounded-sm overflow-hidden shadow">
                <div class="p-4 bg-red-400"><svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-white" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4">
                        </path>
                    </svg></div>
                <div class="px-4 text-gray-700">
                    <h3 class="text-sm tracking-wider">Server Load</h3>
                    <p class="text-3xl">34.12%</p>
                </div>
            </div>
        </div>

        <br>
        <br>

         <table id="example" class="display text-slate-200" style="width:100%">
        <thead>
            <tr>
                <th>S/N</th>
                <th>PRODUCT</th>
                <th>QUANTITY</th>
            </tr>
        </thead>
        <tbody>
            <?php $rowId = 1?>
            <?php foreach($products as $product): ?>
            <tr>
                <td><?= $rowId < 10 ? "0".$rowId++ : $rowId++ ?></td>
                <td><?= $product->productName ?></td>
                <td><?= number_format($product->quantity) ?></td>
            </tr>
            <?php endforeach?>
            </tbody>
            <tfoot>
                <tr class="bg-slate-900">
                    <td><b>Total </b></td>
                    <td></td>
                    <td><b class="text-orange-500"><?= number_format($totalProducts) ?></b></td>
                </tr>
            </tfoot>
         </table>

    </section>
  </main>
  </div>

  <?php include APPPATH . "/views/includes/footer.php"?>
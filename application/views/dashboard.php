  <?php include APPPATH . "/views/includes/header.php"?>
  <?php include APPPATH . "/views/includes/sidebar.php"?>

    <main class="py-4 px-2 lg:px-4 md:ml-64 h-auto pt-20">
      <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-4">
        <div
          class="rounded-lg shadow-2xl p-4  bg-zinc-900 dark:border-gray-600 h-32 md:h-36"
        >
          <p class="text-slate-100 text-xl">Total products</p>
          <p class="text-3xl font-semibold text-slate-300"><?= number_format($totalProducts) ?></p>
      </div>

      <div
        class="rounded-lg shadow-2xl p-4  bg-zinc-900 dark:border-gray-600 h-32 md:h-36"
      >
        <p class="text-slate-100 text-xl">Balance</p>
        <p class="text-3xl font-semibold text-slate-300"><?= format_price($totalIncome) ?></p>
    </div>

        <div
          class="rounded-lg shadow-2xl p-4  bg-zinc-900 dark:border-gray-600 h-32 md:h-36"
        >
          <p class="text-slate-100 text-xl">Expenses </p>
          <p class="text-xl text-orange-500">-Tsh <?= format_price($expensesToday) ?></p>
      </div>


        <!-- <div
          class="rounded-lg shadow-2xl p-3  bg-zinc-900 dark:border-gray-600 h-32 md:h-36"
        >
          <p class="text-slate-100 text-xl">Profit raised</p>
          <p class="text-3xl font-semibold text-slate-300">123,889</p>
          <p class="text-xl text-orange-500">-Tsh 200,000/=</p>
      </div> -->
      </div>


      <div
        class="rounded-lg p-3 shadow-2xl bg-zinc-900 border-gray-300 dark:border-gray-600 h-96 mb-4"
      >
      <p class="text-xl text-slate-200 mb-3">Top selling products </p>
              <div class="relative overflow-x-auto overflow-y-auto">
                  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                          <tr>
                              <th scope="col" class="px-6 py-3">
                                  PRODUCT NAME
                              </th>
                              <th scope="col" class="px-6 py-3">
                                  BRAND
                              </th>
                              <th scope="col" class="px-6 py-3">
                                  AMOUNT SOLD
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach($topSelling as $product):?>
                          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <?= $product->name ?>
                              </th>
                              <td class="px-6 py-4">
                                  <?= $product->brand ?>
                              </td>
                              <td class="px-6 py-4">
                                 <?= number_format($product->totalSales) ?>
                              </td>
                          </tr>
                          <?php endforeach ?>
                      </tbody>
                  </table>
              </div>

      </div>


      <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-4">
        <div
          class="rounded-lg p-3 bg-zinc-900 shadow-2xl border-gray-300 dark:border-gray-600 h-48 md:h-72"
        >
            <p class="text-xl text-slate-200 mb-3">-Today sales per staff </p>
              <div class="relative overflow-x-auto overflow-y-auto">
                  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                          <tr>
                              <th scope="col" class="px-6 py-3">
                                  STAFF NAME
                              </th>
                              <th scope="col" class="px-6 py-3">
                                  PRODUCTS SOLD
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach($todaySales as $sale):?>
                          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <?= $sale->name ?>
                              </th>
                              <td class="px-6 py-4">
                                  <?= number_format($sale->totalSales) ?>
                              </td>
                          </tr>
                          <?php endforeach ?>
                        </tbody>
                  </table>
              </div>
         </div>


        <div
          class="rounded-lg p-3 bg-zinc-900 shadow-2xl border-gray-300 dark:border-gray-600 h-48 md:h-72"
        >
        <p class="text-xl text-slate-200 mb-3">-Today Expenses per staff </p>
              <div class="relative overflow-x-auto overflow-y-auto">
                  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                          <th scope="col" class="px-6 py-3">
                            STAFF NAME
                          </th>
                          <th scope="col" class="px-6 py-3">
                            TOTAL EXPENSES
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($todayExpenses as $expense): ?>
                          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <?= $expense->name ?>
                              </th>
                              <td class="px-6 py-4">
                                <?= format_price($expense->total) ?>
                              </td>
                            </tr>
                          <?php endforeach ?>
                        </tbody>
                  </table>
              </div>

        </div>


        <div
          class="rounded-lg p-3 shandow-2xl bg-zinc-900 border-gray-300 dark:border-gray-600 h-48 md:h-72"
        >
          <p class="text-xl text-slate-200 mb-3">- Sales Per Branch </p>
              <div class="relative overflow-x-auto overflow-y-auto">
                  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                          <tr>
                              <th scope="col" class="px-6 py-3">
                                  BRANCH
                              </th>
                              <th scope="col" class="px-6 py-3">
                                  AMOUNT SOLD
                              </th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php foreach($branchSales as $branch): ?>
                          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <?= $branch->name ?>
                              </th>
                              <td class="px-6 py-4">
                                  <?= format_price($branch->total) ?>
                              </td>
                          </tr>
                          <?php endforeach ?>
                      </tbody>
                  </table>
              </div>

        </div>

        
        <div
          class="rounded-lg p-3 shadow-2xl bg-zinc-900 border-gray-300 dark:border-gray-600 h-48 md:h-72"
        >
          <p class="text-xl text-slate-200 mb-3">Monthly Expenses per Staff </p>
              <div class="relative overflow-x-auto overflow-y-auto">
                  <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                      <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                          <tr>
                              <th scope="col" class="px-6 py-3">
                                  S/N
                              </th>
                              <th scope="col" class="px-6 py-3">
                                  STAFF NAME
                              </th>
                              <th scope="col" class="px-6 py-3">
                                    TOTAL EXPENSES
                              </th>
                              
                          </tr>
                      </thead>
                      <tbody>
                        <?php $rowId = 1 ?>
                        <?php foreach($monthlyExpenses as $expense): ?>
                          <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                              <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                  <?= $rowId > 10 ? '0'.$rowId++ : $rowId++ ?>
                              </th>
                              <td class="px-6 py-4">
                                  <?= $expense->name ?>
                              </td>
                              <td class="px-6 py-4">
                                  <?= format_price($expense->total) ?>
                              </td>
                          </tr>
                          <?php endforeach ?>
                      </tbody>
                  </table>
              </div>

      </div>
      </div>


      <!-- <div
        class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-96 mb-4"
      ></div>



      <div class="grid grid-cols-2 gap-4">
        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>

        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>


        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>

        <div
          class="border-2 border-dashed rounded-lg border-gray-300 dark:border-gray-600 h-48 md:h-72"
        ></div>
      </div> -->
    </main>
  </div>

  <?php include APPPATH . "/views/includes/footer.php"?>
  <?php include APPPATH . "/views/includes/header.php"?>
  <?php include APPPATH . "/views/includes/sidebar.php"?>

    <main class="py-4 px-2 lg:px-4 md:ml-64 h-auto pt-20 grid gap-5">
      <h3 class="text-gray-600 text-xl font-semibold">Admin Dashboard</h3>
       <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
           <div class="flex items-center border border-slate-200 rounded shadow">
             <div class="bg-gradient-to-r from-zinc-900 to-zinc-950 h-full flex items-center justify-center">
               <svg class="text-slate-300 w-14 h-14" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-horizontal-distribute-center"><rect width="6" height="14" x="4" y="5" rx="2"/><rect width="6" height="10" x="14" y="7" rx="2"/><path d="M17 22v-5"/><path d="M17 7V2"/><path d="M7 22v-3"/><path d="M7 5V2"/></svg>
             </div>
             <div class="p-4">
               <p class="text-slate-500">General Stock</p>
               <div>
                 <p class="text-gray-700 text-xl font-semibold"><?= number_format($general_stock) ?></p>
                 <p class="flex gap-2">
                   <span class="bg-sky-900 text-white text-sm inset-0 m-auto px-1 rounded">VALUE</span>
                   <span class="text-green-700 text-xl"><?= format_price($stock_value) ?></span>
                 </p>
               </div>
             </div>
           </div>

           <div class="flex items-center border border-slate-200 rounded shadow">
             <div class="bg-gradient-to-r from-rose-900 to-rose-950 h-full flex items-center justify-center">
               <svg class="text-slate-300 w-14 h-14" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-horizontal-distribute-center"><rect width="6" height="14" x="4" y="5" rx="2"/><rect width="6" height="10" x="14" y="7" rx="2"/><path d="M17 22v-5"/><path d="M17 7V2"/><path d="M7 22v-3"/><path d="M7 5V2"/></svg>
             </div>
             <div class="p-4">
               <p class="text-slate-500">Expenses</p>
               <div>
                 <p class="text-orange-700 text-xl font-semibold"><?= format_price($expenses_today) ?></p>
                 <p class="flex gap-2 items-center">
                   <span class="bg-blue-900 text-white text-sm inset-0 m-auto px-1 rounded">
                    <!-- avoid division by zero -->
                    <?php if($total_cash_income > 0):?>
                      <span class="text-red-500"><?= round(($expenses_today/$total_cash_income)*100, 2) . "%" ?></span> of your income</span>
                   <?php endif ?>
                 </p>
               </div>
             </div>
           </div>

           <div class="flex items-center border border-slate-200 rounded shadow">
             <div class="bg-gradient-to-r from-zinc-900 to-zinc-950 h-full flex items-center justify-center">
               <svg class="text-slate-300 w-14 h-14" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-horizontal-distribute-center"><rect width="6" height="14" x="4" y="5" rx="2"/><rect width="6" height="10" x="14" y="7" rx="2"/><path d="M17 22v-5"/><path d="M17 7V2"/><path d="M7 22v-3"/><path d="M7 5V2"/></svg>
             </div>
             <div class="p-4">
               <p class="text-slate-500">Income</p>
               <div>
                 <p class="text-orange-700 text-xl font-semibold"><?= format_price($total_cash_income) ?></p>
                 <p class="flex gap-2">
                   <span class="bg-blue-900 text-white text-sm inset-0 m-auto px-1 rounded">NET</span>
                   <span class="text-green-700 text-xl"><?= format_price($total_cash_income - $expenses_today) ?></span>
                 </p>
               </div>
             </div>
           </div>

            <div class="flex items-center border border-slate-200 rounded shadow">
             <div class="bg-gradient-to-r from-emerald-900 to-emerald-950 h-full flex items-center justify-center">
               <svg class="text-slate-300 w-14 h-14" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-align-horizontal-distribute-center"><rect width="6" height="14" x="4" y="5" rx="2"/><rect width="6" height="10" x="14" y="7" rx="2"/><path d="M17 22v-5"/><path d="M17 7V2"/><path d="M7 22v-3"/><path d="M7 5V2"/></svg>
             </div>
             <div class="p-4">
               <p class="text-slate-500">Profit</p>
               <div>
                 <p class="text-orange-700 text-xl font-semibold"><?= format_price($profit_today) ?></p>
                 <p class="flex gap-2">
                   <span class="bg-blue-900 text-white text-sm inset-0 m-auto px-1 rounded">NET</span>
                   <span class="text-green-700 text-xl"><?= format_price($profit_today - $expenses_today) ?></span>
                 </p>
               </div>
             </div>
           </div>
       </section>

       
      <section class="grid gap-4 grid-cols-1 lg:grid-cols-2">
        <div class="w-full bg-slate-50 rounded-lg shadow p-4 md:p-6">
          <h3 class="text-gray-500 text-lg my-3">- Monthly Sales</h3>
        
          <table class="text-gray-500">
            <tr>
              <th class="text-base text-left pl-3">OFFICE</th>
              <th class="text-base text-left pl-3">INCOME</th>
              <th class="text-base text-left pl-3">PROFIT</th>
            </tr>
            <?php 
              $total_income = 0;
              $total_profit = 0;
            ?>
            <?php foreach($sales as $sale):?>
              <tr>
                <td><?= $sale->branch ?></td>
                <td><?= format_price($sale->quantity * $sale->price) ?></td>
                <?php 
                 $total_income += ($sale->quantity * $sale->price);
                 $total_profit += (($sale->price - $sale->buy_price) * $sale->quantity);
                ?>
                <td><?= format_price(($sale->price - $sale->buy_price) * $sale->quantity) ?></td>
              </tr>
            <?php endforeach ?>
            <tfoot>
               <tr class="text-green-600">
                <th>TOTAL </th>
                <th><?= format_price($total_income) ?></th>
                <th><?= format_price($total_profit) ?></th>
               </tr>
            </tfoot>
          </table>

          <div class="flex justify-between border-gray-200 border-b dark:border-gray-700 pb-3 pt-4">
            <dl>
              <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Net Profit</dt>
              <dd class="leading-none text-3xl font-bold text-gray-900 dark:text-white"><?= format_price($total_profit - $expenses_monthly) ?></dd>
            </dl>
            <div>
              <span class="bg-green-100 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md dark:bg-green-900 dark:text-green-300">
                <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 14">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13V1m0 0L1 5m4-4 4 4"/>
                </svg>
                Profit rate 23.5%
              </span>
            </div>
          </div>
        
          <div class="grid grid-cols-2 py-3">
            <dl>
              <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Net Income</dt>
              <dd class="leading-none text-xl font-bold text-green-500 dark:text-green-400"><?= format_price($total_income - $expenses_monthly) ?></dd>
            </dl>
            <dl>
              <dt class="text-base font-normal text-gray-500 dark:text-gray-400 pb-1">Expense</dt>
              <dd class="leading-none text-xl font-bold text-red-600 dark:text-red-500">- <?= format_price($expenses_monthly) ?></dd>
            </dl>
          </div>
          
        </div>

        <div class="w-full rounded-lg shadow py-4">
            <h3 class="text-gray-500 text-lg my-3">- Top selling products</h3>
            <table class="text-gray-500">
              <thead>
                <tr>
                   <th style="font-weight: 400; font-size: small">S/N</th>
                   <th style="font-weight: 400; font-size: small">PRODUCT</th>
                   <th style="font-weight: 400; font-size: small">BRANCH</th>
                   <th style="font-weight: 400; font-size: small">QUANTITY SOLD</th>
                </tr>
              </thead>
              <tbody>
                <?php $rowId = 1?>
                <?php foreach($top_products as $product):?>
                  <tr>
                    <td><?= $rowId < 10 ? '0'.$rowId++ : $rowId++ ?></td>
                    <td><?= $product->name ?></td>
                    <td><?= $product->branch ?></td>
                    <td><?= number_format($product->quantity) ?></td>
                  </tr>
                <?php endforeach ?>
              </tbody>
            </table>
        </div>
      </section>

    </main>
  </div>


  <?php include APPPATH . "/views/includes/footer.php"?>
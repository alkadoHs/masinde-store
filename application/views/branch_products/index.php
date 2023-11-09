  <?php include APPPATH . "/views/includes/header.php"?>
  <?php include APPPATH . "/views/includes/sidebar.php"?>

  <main class="py-4 px-2 lg:px-4 md:ml-64 h-auto pt-20 ">
    <section class="bg-gray-50 dark:bg-gray-900">
        
        <ul class="text-sm font-medium text-center text-gray-500 divide-x divide-gray-200 rounded-lg shadow sm:flex dark:divide-gray-700 dark:text-gray-400"  id="default-tab" data-tabs-toggle="#default-tab-content" role="tablist">
            <li class="w-full" role="presentation">
                <a href="<?= site_url("branchProducts/index/1") ?>" class="inline-block w-full p-4 text-gray-900 bg-gray-100 rounded-l-lg focus:ring-4 focus:ring-blue-300 <?= $active_tab ?> focus:outline-none dark:bg-gray-700 dark:text-white" aria-current="page" id="mainstore-tab" data-tabs-target="#mainstore" type="button" role="tab" aria-controls="mainstore" aria-selected="false">MAIN STORE</a>
            </li>
            <li class="w-full" role="presentation">
                <a href="<?= site_url("branchProducts/index/2") ?>" class="inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 <?= $active_tab ?> focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700" >UYOLE SHOP</a>
            </li>
            <li class="w-full" role="presentation">
                <a href="<?= site_url("branchProducts/index/3") ?>" class="inline-block w-full p-4 bg-white hover:text-gray-700 hover:bg-gray-50 focus:ring-4 focus:ring-blue-300 <?= $active_tab ?> focus:outline-none dark:hover:text-white dark:bg-gray-800 dark:hover:bg-gray-700">MBALIZI</a>
            </li>
        </ul>

      <div id="default-tab-content">
        <!-- MAIN STORE TAB  CONTENTS -->
        <div class="hidden rounded-lg bg-gray-50 dark:bg-gray-800" id="mainstore" role="tabpanel" aria-labelledby="mainstore-tab">
            <section class="bg-gray-50 dark:bg-gray-900 py-3 sm:py-5">
                <?php if($this->session->flashdata("create_branchproduct_success")): ?>
                    <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Success!</span> <?= $this->session->flashdata("create_branchproduct_success") ?>
                        </div>
                    </div>
                <?php elseif($this->session->flashdata("update_branchproduct_success")): ?>
                    <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Success!</span> <?= $this->session->flashdata("update_branchproduct_success") ?>
                        </div>
                    </div>
                <?php elseif($this->session->flashdata("delete_branchproduct_success")): ?>
                     <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Success!</span> <?= $this->session->flashdata("delete_branchproduct_success") ?>
                        </div>
                    </div>
                <?php elseif($this->session->flashdata("delete_branchproduct_failure")): ?>
                     <div class="flex items-center p-4 mb-4 text-sm text-green-800 border border-green-300 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 dark:border-green-800" role="alert">
                        <svg class="flex-shrink-0 inline w-4 h-4 mr-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div>
                            <span class="font-medium">Success!</span> <?= $this->session->flashdata("delete_branchproduct_failure") ?>
                        </div>
                    </div>
                <?php endif ?>
                <div class="mx-auto max-w-screen-2xl lg:px-2">
                    <div class="relative overflow-hidden bg-white shadow-md dark:bg-gray-800 sm:rounded-lg">
                        <div class="my-3 px-4 flex gap-3 items-center">
                             <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-orange-400 animate-pulse">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />
                            </svg>
                            <h4 class="text-green-400 text-lg font-semibold"><?= $branch_name ?> PRODUCTS</h4>
                        </div>
                        <div class="flex flex-col px-4 py-3 space-y-3 lg:flex-row lg:items-center lg:justify-between lg:space-y-0 lg:space-x-4">
                            <div class="flex items-center flex-1 space-x-4">
                                <!-- <h5>
                                    <span class="text-gray-500">All Products:</span>
                                    <span class="dark:text-white">123456</span>
                                </h5>
                                <h5>
                                    <span class="text-gray-500">Total sales:</span>
                                    <span class="dark:text-white">$88.4k</span>
                                </h5> -->
                            </div>
                            <div class="flex flex-col flex-shrink-0 space-y-3 md:flex-row md:items-center lg:justify-end md:space-y-0 md:space-x-3">
                                <button type="button"  id="createProductButton" data-modal-toggle="createProductModal" class="flex items-center justify-center px-4 py-2 text-sm font-medium text-white rounded-lg bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:ring-sky-300 dark:bg-sky-600 dark:hover:bg-sky-700 focus:outline-none dark:focus:ring-sky-800">
                                    <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                        <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" />
                                    </svg>
                                    Add Stock
                                </button>


                                                        <!-- End block -->
                                <div id="createProductModal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] md:h-full">
                                    <div class="relative p-4 w-full max-w-3xl h-full md:h-auto">
                                        <!-- Modal content -->
                                        <div class="relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                            <!-- Modal header -->
                                            <div class="flex justify-between items-center pb-4 mb-4 rounded-t border-b sm:mb-5 dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Add Product</h3>
                                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="createProductModal">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <!-- Modal body -->
                                            <?php echo form_open("branchproducts/create") ?>
                                                <div class="grid gap-4 mb-4 sm:grid-cols-1">
                                                    <div class="w-full">
                                                        <label for="productId" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Select product</label>
                                                        <select id="productId" name="productId" class="select2 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" style="width:100%" required>
                                                        <option selected>Choose product</option>
                                                        <?php foreach($main_products as $product): ?>
                                                            <option value="<?php echo $product->id ?>"><?php echo $product->name ?></option>
                                                        <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <input type="hidden" name="branchId" value="<?= $branch_id ?>">
                                                    
                                                    <div class="grid gap-4 sm:col-span-2 md:gap-6 sm:grid-cols-4">
                                                        <div>
                                                            <label for="quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantity</label>
                                                            <input type="number" name="quantity" id="quantity" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-600 focus:border-sky-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-500 dark:focus:border-sky-500" placeholder="" required="">
                                                        </div>
                                                        <div>
                                                            <label for="damages" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Damages</label>
                                                            <input type="number" name="damages" id="damages" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-600 focus:border-sky-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-500 dark:focus:border-sky-500" placeholder="" required="">
                                                        </div>
                                                        <div>
                                                            <label for="stockLimit" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Stock Limit</label>
                                                            <input type="number" name="stockLimit" id="stockLimit" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-sky-600 focus:border-sky-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-sky-500 dark:focus:border-sky-500" placeholder="" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="items-center space-y-4 sm:flex sm:space-y-0 sm:space-x-4">
                                                    <button type="submit" class="w-full sm:w-auto justify-center text-white inline-flex bg-sky-700 hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">Add stock</button>
                                                  
                                                    <button data-modal-toggle="createProductModal" type="button" class="w-full justify-center sm:w-auto text-gray-500 inline-flex items-center bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-sky-300 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10 dark:bg-gray-700 dark:text-gray-300 dark:border-gray-500 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-600">
                                                        <svg class="mr-1 -ml-1 w-5 h-5" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                        </svg>
                                                        Discard
                                                    </button>
                                                </div>
                                            <?php echo form_close() ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <button type="button" class="flex items-center justify-center flex-shrink-0 px-3 py-2 text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg focus:outline-none hover:bg-gray-100 hover:text-sky-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewbox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75V16.5m-13.5-9L12 3m0 0l4.5 4.5M12 3v13.5" />
                                    </svg>
                                    Export
                                </button>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 display" id="example">
                                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="p-4">
                                            <div class="flex items-center">
                                                <input id="checkbox-all" type="checkbox" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-sky-600 focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-all" class="sr-only">checkbox</label>
                                            </div>
                                        </th>
                                        <th scope="col" class="px-4 py-3">PRODUCT</th>
                                        <th scope="col" class="px-4 py-3">BRAND</th>
                                        <th scope="col" class="px-4 py-3">UNIT</th>
                                        <th scope="col" class="px-4 py-3">STOCK</th>
                                        <th scope="col" class="px-4 py-3">DEMAGES</th>
                                        <!-- <th scope="col" class="px-4 py-3">Sales/Day</th>
                                        <th scope="col" class="px-4 py-3">Sales/Month</th> -->
                                        <th scope="col" class="px-4 py-3">BUYING PRICE</th>
                                        <th scope="col" class="px-4 py-3">RETAIL PRICE</th>
                                        <th scope="col" class="px-4 py-3">WHOLE PRICE</th>
                                        <th scope="col" class="px-4 py-3">OUT</th>
                                        <th scope="col" class="px-4 py-3">RETAIL REVENUE</th>
                                        <th scope="col" class="px-4 py-3">WHOLESALE REVENUE</th>
                                        <th scope="col" class="px-4 py-3">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $totalRetail = 0 ?>
                                    <?php $totalWhole = 0 ?>
                                    <?php $totalStock = 0 ?>
                                    <?php $totalOut = 0?>
                                    <?php $totalOutRevenue = 0 ?>
                                    <?php foreach($mainbranch_products as $branch_product): ?>
                                    <tr>
                                        <td class="w-4 px-4 py-3">
                                            <div class="flex items-center">
                                                <input id="checkbox-table-search-1" type="checkbox" onclick="event.stopPropagation()" class="w-4 h-4 bg-gray-100 border-gray-300 rounded text-sky-600 focus:ring-sky-500 dark:focus:ring-sky-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                                <label for="checkbox-table-search-1" class="sr-only">checkbox</label>
                                            </div>
                                        </td>
                                        <th scope="row" class="flex items-center px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <b><?= $branch_product->name ?></b>
                                        </th>
                                        <td class="px-4 py-2">
                                            <span class="bg-sky-100 text-sky-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-sky-900 dark:text-sky-300"><?= $branch_product->brand ?></span>
                                        </td>
                                        <td class="px-4 py-2">
                                            <span class="bg-sky-100 text-fuchsia-800 text-xs font-medium px-2 py-0.5 rounded dark:bg-fuchsia-900 dark:text-fuchsia-300"><?= $branch_product->unit ?></span>
                                        </td>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex items-center">
                                                <?php if($branch_product->branch_inventory <= $branch_product->branch_stockLimit ):?>
                                                <div class="inline-block w-4 h-4 mr-2 bg-red-700 rounded-full"></div>
                                                <?php else: ?>
                                                <div class="inline-block w-4 h-4 mr-2 bg-green-700 rounded-full"></div>
                                                <?php endif; ?>
                                                <?php $totalStock += $branch_product->branch_inventory?>
                                                <span><?= number_format($branch_product->branch_inventory)?></span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= $branch_product->branch_damages ?></td>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= format_price($branch_product->buyPrice) ?></td>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex items-center">
                                                
                                                <span class="ml-1 text-gray-500 dark:text-gray-400"><?= format_price($branch_product->retailPrice) ?></span>
                                            </div>
                                        </td>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <span><?= format_price($branch_product->wholePrice) ?></span>
                                        </td>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <div class="flex items-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewbox="0 0 24 24" fill="currentColor" class="w-5 h-5 mr-2 text-gray-400" aria-hidden="true">
                                                    <path d="M2.25 2.25a.75.75 0 000 1.5h1.386c.17 0 .318.114.362.278l2.558 9.592a3.752 3.752 0 00-2.806 3.63c0 .414.336.75.75.75h15.75a.75.75 0 000-1.5H5.378A2.25 2.25 0 017.5 15h11.218a.75.75 0 00.674-.421 60.358 60.358 0 002.96-7.228.75.75 0 00-.525-.965A60.864 60.864 0 005.68 4.509l-.232-.867A1.875 1.875 0 003.636 2.25H2.25zM3.75 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0zM16.5 20.25a1.5 1.5 0 113 0 1.5 1.5 0 01-3 0z" />
                                                </svg>
                                                <?php $totalOut += ($branch_product->branch_quantity - $branch_product->branch_inventory) ?>
                                                <span><?= number_format($branch_product->branch_quantity - $branch_product->branch_inventory) ?></span>
                                            </div>
                                        </td>
                                      
                                        <?php $totalRetail += $branch_product->retailPrice * $branch_product->branch_inventory ?>
                                        <td class="px-4 py-2"><?= format_price($branch_product->retailPrice * $branch_product->branch_inventory) ?></td>
                                        <?php $totalWhole += $branch_product->wholePrice * $branch_product->branch_inventory ?>
                                        <td class="px-4 py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?= format_price($branch_product->wholePrice * $branch_product->branch_inventory) ?></td>
                                         <td class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <div class="flex items-center space-x-4">
                                            <a href="<?= site_url("branchProducts/edit/".$branch_product->branch_product_id."/".$branch_product->name)  ?>" class="py-2 px-3 flex items-center text-sm font-medium text-center text-white bg-sky-700 rounded-lg hover:bg-sky-800 focus:ring-4 focus:outline-none focus:ring-sky-300 dark:bg-sky-600 dark:hover:bg-sky-700 dark:focus:ring-sky-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 -ml-0.5" viewbox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                                </svg>
                                                Preview
                                            </a>
                                        </div>
                                    </td>
                                    </tr>
                                    <?php endforeach ?>
                                </tbody>
                                 <tfoot>
                                    <tr>
                                        <th>TOTAL </th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Stock: <span class="text-orange-500 font-bold animate-pulse"><?= number_format($totalStock) ?></span></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th></th>
                                        <th>Out: <span class="text-orange-500 font-bold animate-pulse"><?= number_format($totalOut) ?></span> </th></th>
                                        <th>Retail: <span class="text-orange-500 font-bold animate-pulse"><?= format_price($totalRetail) ?></span> </th>
                                        <th>Whole: <span class="text-orange-500 font-bold animate-pulse"><?= format_price($totalWhole) ?></span></th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </section>
        </div>

       <!-- UYOLE BRANCH TAB CONTENTS -->
      </div>
      </div>  
    </section> 
  </main>
  </div>

  <?php include APPPATH . "/views/includes/footer.php"?>
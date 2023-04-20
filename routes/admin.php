<?php

//Admin Dashboard Import
use App\Http\Controllers\Backend\Auth\ChangePasswordController;
//Admin Controller Import
use App\Http\Controllers\Backend\Auth\LoginController;
use App\Http\Controllers\Backend\Auth\LogoutController;
use App\Http\Controllers\Backend\Auth\RegisterController;
use App\Http\Controllers\Backend\Auth\ResetController;
use App\Http\Controllers\Backend\Page\DashboardController;
use App\Http\Controllers\Backend\Page\ProfileController;
//Import Admin Product Related Stuff
use App\Http\Controllers\Backend\Product\BrandController;
use App\Http\Controllers\Backend\Product\CategoryController;
use App\Http\Controllers\Backend\Product\InventoryController;
use App\Http\Controllers\Backend\Product\InventoryTransferController;
use App\Http\Controllers\Backend\Product\ProductController;
use App\Http\Controllers\Backend\Product\SupplierController;
//Import Admin Transaction Stuff
use App\Http\Controllers\Backend\Reports\ReportController;
use App\Http\Controllers\Backend\Transaction\OrderController;
use App\Http\Controllers\Backend\Transaction\PostController;
use App\Http\Controllers\Backend\Users\CustomerController;
use App\Http\Controllers\Backend\Users\RoleController;
use App\Http\Controllers\Backend\Users\UsersController;

Route::group(['prefix' => 'admin'], function () {
    Route::middleware(['guest:web', 'PreventBackHistory'])->group(function () {
        Route::resource('login', LoginController::class)->only(['index', 'store']);
        Route::resource('register', RegisterController::class)->only(['index', 'store']);
        Route::get('reset/password/{token}', [ResetController::class, 'ShowResetForm'])->name('reset.password.form');
        Route::post('reset/password', [ResetController::class, 'ResetPassword'])->name('reset.password');
        Route::resource('reset', ResetController::class)->only(['index', 'store']);
    });

    Route::middleware(['auth:web'])->group(function () {
        //Begin: Export Files for Category
        Route::get('/category/excel', [CategoryController::class, 'exportcategoriesexcel'])->name('exportcategoriesexcel');
        Route::get('/category/csv', [CategoryController::class, 'exportcategoriescsv'])->name('exportcategoriescsv');
        Route::get('/category/html', [CategoryController::class, 'exportcategorieshtml'])->name('exportcategorieshtml');
        Route::get('/category/pdf', [CategoryController::class, 'exportcategoriespdf'])->name('exportcategoriespdf');
        //End: Export Files for Category
        //Begin: Export Files for Brand
        Route::get('/brand/excel', [BrandController::class, 'exportbrandexcel'])->name('exportbrandexcel');
        Route::get('/brand/csv', [BrandController::class, 'exportbrandcsv'])->name('exportbrandcsv');
        Route::get('/brand/html', [BrandController::class, 'exportbrandhtml'])->name('exportbrandhtml');
        Route::get('/brand/pdf', [BrandController::class, 'exportbrandpdf'])->name('exportbrandpdf');
        //End: Export Files for Brand
        //Begin: Export Files for Product
        Route::get('/product/excel', [ProductController::class, 'exportproductexcel'])->name('exportproductexcel');
        Route::get('/product/csv', [ProductController::class, 'exportproductcsv'])->name('exportproductcsv');
        Route::get('/product/html', [ProductController::class, 'exportproducthtml'])->name('exportproducthtml');
        Route::get('/product/pdf', [ProductController::class, 'exportproductpdf'])->name('exportproductpdf');
        //End: Export Files for Product
        //Begin:Export Files for Supplier
        Route::get('/supplier/excel', [SupplierController::class, 'exportsupplierexcel'])->name('exportsupplierexcel');
        Route::get('/supplier/csv', [SupplierController::class, 'exportsuppliercsv'])->name('exportsuppliercsv');
        Route::get('/supplier/html', [SupplierController::class, 'exportsupplierhtml'])->name('exportsupplierhtml');
        Route::get('/supplier/pdf', [SupplierController::class, 'exportsupplierpdf'])->name('exportsupplierpdf');
        //End: Export Files for Supplier
        //Begin:Export Files for Role
        Route::get('/role/excel', [RoleController::class, 'exportroleexcel'])->name('exportroleexcel');
        Route::get('/role/csv', [RoleController::class, 'exportrolecsv'])->name('exportrolecsv');
        Route::get('/role/html', [RoleController::class, 'exportrolehtml'])->name('exportrolehtml');
        Route::get('/role/pdf', [RoleController::class, 'exportrolepdf'])->name('exportrolepdf');
        //End: EXport Files for Role
        //Begin: Export Files for System Report
        Route::get('/report/browser/excel/{startdate}/{enddate}', [ReportController::class, 'exportbrowsertypeexcel'])->name('exportbrowsertypeexcel');
        Route::get('/report/UserType/excel/{startdate}/{enddate}', [ReportController::class, 'exportusertypeexcel'])->name('exportusertypeexcel');
        Route::get('/report/cancelledorders/excel',[ReportController::class,'exportCancelledOrdersExcel'])->name('exportCancelledOrdersExcel');
        Route::get('/report/cancellationreasons/excel',[ReportController::class,'exportCancellationReasonsExcel'])->name('exportCancellationReasonsExcel');
        Route::get('/report/rejectedorders/excel',[ReportController::class,'exportRejectedOrdersExcel'])->name('exportRejectedOrdersExcel');
        Route::get('/report/cancellationovertime/excel',[ReportController::class,'exportCancellationOverTime'])->name('report.exportCancellationOverTime');
        Route::get('/report/monthlycancellation/excel/{month}/{year}',[ReportController::class,'exportMonthlyCancellation'])->name('report.exportMonthlyCancellation');
        Route::get('/report/customerPerMonth/excel',[ReportController::class,'exportCustomerPerMonthEXCEL'])->name('exportCustomerPerMonthEXCEL');
        Route::get('/report/productbycustomer/excel/',[ReportController::class,'exportProductByCustomerExcel'])->name('report.exportProductByCustomerExcel');
        Route::get('/report/VerifiedAccount/excel/',[ReportController::class,'exportVerifiedAccountsExcel'])->name('report.exportVerifiedAccountsExcel');
        Route::get('/report/NonVerifiedAccount/excel/',[ReportController::class,'exportNonVerifiedAccountsExcel'])->name('report.exportNonVerifiedAccountsExcel');
        Route::get('/report/OrdersByProduct/excel/',[ReportController::class,'exportOrdersByProductExcel'])->name('report.exportOrdersByProductExcel');
        Route::get('/report/OrdersByCustomer/customerbyproduct/excel/',[ReportController::class,'exportOrdersByCustomer'])->name('report.exportOrdersByCustomer');
        Route::get('/report/customerbyproduct/excel/{name}',[ReportController::class,'exportCustomerByProductExcel'])->name('report.exportCustomerByProductExcel');
        Route::get('/report/MostVisitedPage/excel/{startdate}/{enddate}', [ReportController::class, 'exportMostVisitedPageExcel'])->name('exportMostVisitedPageExcel');
        Route::get('/report/PaymentByType/excel/{startdate}/{enddate}', [ReportController::class, 'exportPaymentByType'])->name('report.exportPaymentByType');
        Route::get('/report/productratings/excel/{sorting}/{startdate}/{enddate}',[ReportController::class,'exportProductRatingsExcel'])->name('report.exportProductRatingsExcel');
        Route::get('/report/productratings/ProductRatingsByCustomer/excel/{sorting}/{startdate}/{enddate}/{name}',[ReportController::class,'exportProductRatingsByCustomerExcel'])->name('report.exportProductRatingsByCustomerExcel');
        //End: Export Files for System Report
        //Begin Export Files for Sales Report
        Route::get('/report/salesprod/html', [ReportController::class, 'exportSalesProductHTML'])->name('exportSalesProductHTML');
        Route::get('/report/SalesOvertime/excel', [ReportController::class, 'exportsalesovertime'])->name('exportsalesovertime');
        Route::get('/report/salesprod/pdf', [ReportController::class, 'exportSalesProductPDF'])->name('exportSalesProductPDF');
        Route::get('/report/salesprod/excel/{sorting}/{startdate}/{enddate}', [ReportController::class, 'exportSalesProductEXCEL'])->name('exportSalesProductEXCEL');
        Route::get('/report/salesbrand/excel/{sorting}/{startdate}/{enddate}', [ReportController::class, 'exportSalesBrandEXCEL'])->name('exportSalesBrandEXCEL');
        Route::get('/report/salescategory/excel/{sorting}/{startdate}/{enddate}', [ReportController::class, 'exportSalesCategoryEXCEL'])->name('exportSalesCategoryEXCEL');
        Route::get('/report/orderbrand/excel/{sorting}/{startdate}/{enddate}', [ReportController::class, 'exportOrderBrandExcel'])->name('exportOrderBrandExcel');
        Route::get('/report/ordercategory/excel/{sorting}/{startdate}/{enddate}', [ReportController::class, 'exportOrderCategoryExcel'])->name('exportOrderCategoryExcel');
        Route::get('/report/CustomersTotalSpent/excel/{sorting}/{startdate}/{enddate}',[ReportController::class,'exportCustomerTotalSpent'])->name('exportCustomerTotalSpent');
        //End: Export Files for Sales Report
        //Begin: Export Files for Demographics Report
        Route::get('/report/gender/excel', [ReportController::class, 'exportGenderExcel'])->name('exportGenderExcel');
        //End: Export Files for Demographics Report

        Route::middleware(['PreventBackHistory'])->group(function () {
            //Begin: Logout Module
            Route::get('/logout', [LogoutController::class, 'store'])->name('logout');
            //End: Logout Module
            //Begin: Dashboard Module
            Route::resource('dashboard', DashboardController::class)->only(['index']);
            //End: Dashboard Module
            //Begin: Product Attribute Module
            Route::resource('brand', BrandController::class)->only(['index']);
            Route::resource('category', CategoryController::class)->only('index');
            //End: Product Attribute
            //Begin: Inventory Module
            Route::resource('inventory', InventoryController::class)->except(['edit', 'show', 'create']);
            Route::get('product/inventory_history/{id}', [ProductController::class, 'ProductInventoryHistory'])->name('ProductInventoryHistory');
            //End: Inventory Module
            //Begin: Purchase Order Module
            Route::resource('transfer', InventoryTransferController::class);
            Route::get('/receive/{id}', [InventoryTransferController::class, 'receive'])->name('inventory.receive');
            //End: Purchase Order Module
            //Begin: Product Module
            Route::get('/product/archive', [ProductController::class, 'ProductArchiveIndex'])->name('ProductArchiveIndex');
            Route::delete('/product/archive/{id}', [ProductController::class, 'ProductArchiveDestroy']);
            Route::put('/product/archive/{id}', [ProductController::class, 'ProductArchiveRestore']);
            Route::get('/product/featuredproducts', [ProductController::class, 'FeaturedProductIndex'])->name('product.FeaturedProduct');
            Route::resource('product', ProductController::class);
            //End: Product Module
            //Begin: Order Module
            Route::resource('orders', OrderController::class)->only('index', 'show');
            //End: Order Module
            //Begin: Banner Module
            Route::resource('post', PostController::class)->only('index');
            //End: Banner Module
            //Begin: Supplier Module
            Route::get('/supplier/archive', [SupplierController::class, 'SupplierArchiveIndex'])->name('SupplierArchiveIndex');
            Route::resource('supplier', SupplierController::class);
            //End: Supplier Module
            //Begin: Profile Module
            Route::get('/profile/changepassword', [ProfileController::class, 'changepass'])->name('AdminChangePass');
            Route::post('/profile/changepassword', [ProfileController::class, 'resetpass']);
            Route::resource('profile', ProfileController::class)->only('index');
            Route::resource('changepassword', ChangePasswordController::class)->only('index');
            //End: Profile Module

            //Begin:List Of Reports: System
            Route::get('/report/cancelledorders',[ReportController::class,'CancelledOrders'])->name('report.CancelledOrders');
            Route::get('/report/cancellationreasons',[ReportController::class,'CancellationReasons'])->name('report.CancellationReasons');
            Route::get('/report/rejectedorders',[ReportController::class,'RejectedOrders'])->name('report.RejectedOrders');
            Route::get('/report/cancellationovertime',[ReportController::class,'CancellationOverTime'])->name('report.CancellationOverTime');
            Route::get('/report/monthlycancellation/{month}/{year}', [ReportController::class,'MonthlyCancellation'])->name('report.MonthlyCancellation');
            Route::get('/report/customerPerMonth',[ReportController::class,'customerPerMonth'])->name('report.customerPerMonth');
            Route::get('/report/showCustomerPerMonth/{month}/{year}', [ReportController::class,'showCustomerPerMonth'])->name('report.ShowCustomerPerMonth');
            Route::get('/report/PaymentByType', [ReportController::class, 'PaymentTypeIndex'])->name('report.PaymentByType');
            Route::get('/report/UserType', [ReportController::class, 'UserTypeIndex'])->name('report.UserType');
            Route::get('/report/MostVisitedPage', [ReportController::class, 'MostVisitedPageIndex'])->name('report.MostVisitedPageIndex');
            Route::get('/report/SalesOvertime', [ReportController::class, 'SalesOvertimeIndex'])->name('report.SalesOvertime');
            Route::get('/report/Cancellation', [ReportController::class, 'CancellationIndex'])->name('report.Cancellation');
            Route::get('/report/accountverification',[ReportController::class,'AccountVerification'])->name('report.AccountVerification');
            Route::get('/report/VerifiedAccount',[ReportController::class,'VerifiedAccount'])->name('report.VerifiedAccount');
            Route::get('/report/NonVerifiedAccount',[ReportController::class,'NonVerifiedAccount'])->name('report.NonVerifiedAccount');
            Route::get('/report/TopBuyerPerProduct',[ReportController::class,'TopBuyerPerProduct'])->name('report.TopBuyerPerProduct');
            Route::get('/report/OrdersByProduct',[ReportController::class,'OrdersByProduct'])->name('report.OrdersByProduct');
            Route::get('/report/OrdersByProduct/ProductByCustomer/{name}',[ReportController::class,'ProductByCustomer'])->name('report.ProductByCustomer');
            Route::get('/report/OrdersByCustomer',[ReportController::class,'OrdersByCustomer'])->name('report.OrdersByCustomer');
            Route::get('/report/OrdersByCustomer/CustomerByProduct/{name}',[ReportController::class,'CustomerByProduct'])->name('report.CustomerByProduct');
            Route::get('/report/browser', [ReportController::class, 'BrowserIndex'])->name('report.browser');

            Route::get('/report/productratings',[ReportController::class,'ProductRatings'])->name('report.ProductRatings');
            Route::get('/report/productratings/ProductRatingsByCustomer/{product_id}/{product_name}',[ReportController::class,'ProductRatingsByCustomer'])->name('report.ProductRatingsByCustomer');
            //Return To Be Made Soon
            Route::get('/report/Return', [ReportController::class, 'ReturnIndex'])->name('report.Return');
            //End: List of Reports: System

            //Begin: List of Reports: Demographics
            Route::get('/report/gender', [ReportController::class, 'GenderIndex'])->name('report.Gender');
            //End: List of Reports: Demographics

            //Begin: List of Reports: Sales
            Route::get('/report/salesprod', [ReportController::class, 'salesProd'])->name('report.SalesProd');
            Route::get('/report/CustomersTotalSpent', [ReportController::class, 'CustomersTotalSpent'])->name('report.CustomersTotalSpent');
            Route::get('/report/salesbrand', [ReportController::class, 'salesBrand'])->name('report.SalesBrand');
            Route::get('/report/orderbrand', [ReportController::class, 'BrandOrderIndex'])->name('report.OrderBrand');
            Route::get('/report/salescategory', [ReportController::class, 'salesCategory'])->name('report.SalesCategory');
            Route::get('/report/ordercategory', [ReportController::class, 'CategoryOrderIndex'])->name('report.OrderCategory');
            //End: List of Reports: Sales
            //Begin: Reports Table
            Route::resource('report', ReportController::class);
            //End: Reports Table
            //Begin: Customers Module
            Route::get('/customer/archive', [CustomerController::class, 'CustomerArchiveIndex'])->name('CustomerArchiveIndex');
            Route::resource('customer', CustomerController::class)->only('index', 'show');
            //End: Customers Module

            //Begin: Users Module
            Route::get('/user/archive', [UsersController::class, 'UserArchiveIndex'])->name('UserArchiveIndex');
            Route::resource('user', UsersController::class);
            Route::post('role/{role}/permissions', [RoleController::class, 'givePermission'])->name('roles.permissions');
            Route::delete('role/{role}/permissions/{permission}', [RoleController::class, 'revokePermission'])->name('roles.permissions.revoke');
            Route::resource('role', RoleController::class);
            //End: Users Module

        });
    });
});

<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Cấu trúc
// Route::phương thức('đường dẫn', function () {
//     code php xử lý
// });

// Route::get('', function () {
//     return "Xin chao phúc";
// });

//truyền tham số trên route
//truyền 1 tham số
// Route::get('xinchao/{ten}', function ($ten) {
//     return "Xin chao:".$ten;
// });
//truyền nhiều tham số
// Route::get('thongtin/{ten}/{sodt}', function ($ten,$sodt) {
//     return "Xin chao:".$ten."<br> số điện thoại là:".$sodt;
// });

//truyền tham số mặc định
// Route::get('thanhvien/{name?}', function ($name="admin") {
//     return "Thanh vien có tên là :".$name;
// });

//group route


// Route::group(['prefix' => 'thanhvien'], function () {
//     Route::get('danhsach', function () {
//         return "Đây là trang danh sách thành viên";
//     });
//     Route::get('them', function () {
//         return "Đây là trang thêm thành viên";
//     });
//     Route::get('sua', function () {
//         return "Đây là trang sửa thành viên";
//     });
// });
Route::group(['prefix' => 'schema'], function () {

    // Tạo Bảng

    Route::get('create-table', function () {

       Schema::create('bang', function ($table) {

        //Ghi chú
        // Không thêm điều kiện bổ xung thì mặc định các trừng đều không cho phép để trống (Ngoại trừ timestamps)
           //khởi tạo các trường trong bảng
           $table->increments('id'); //kiểu int - unsigned - auto-incriment - primary key
           $table->string('cot1')->default("xin chào"); // kiểu varchar chiều dài tối đa là  100 ký tự
           $table->integer('cot2')->unsigned(); //Kiểu int 
           $table->text('cot3')->nullable(); //kiểu text
           $table->timestamps(); // tạo 2 cột created_at và update_at

       });


    });


    // Xoá bảng
    Route::get('del-table', function () {

        //xoá bảng (Nếu không tồn tại bảng sẽ bị lỗi)
        // Schema::drop('bang');

        //xoá bảng nếu tồn tại không tồn tại vẫn thực thi
        Schema::dropIfExists('bang');
        
    });

     // Sửa Tên bảng
     Route::get('rename-table', function () {
         //cấu trúc :  Schema::rename('Tên bảng cũ', 'Tên bảng mới');
       Schema::rename('bang', 'bang_moi');
        
    });

    // -------------------------------------Tác động đến cột trong bảng

    // Thêm Cột
    Route::get('create_col', function () {

        Schema::table('bang_moi', function ($table) {
            $table->text('cot4')->nullable();
        });
        
    });
    
    // Sửa cột
    Route::get('update_col', function () {

        Schema::table('bang_moi', function ($table) {
            $table->renameColumn('cot4', 'cot5');
        });
        
    });

    //xoá Cột
    Route::get('del_col', function () {
        Schema::table('bang_moi', function ($table) {
            // xoá 1 cột
            $table->dropColumn('cot5');
            //hoặc xóa nhiều cột cùng lúc.
            // $table->dropColumn(['columnName1','columnName2','columnName3']);
        });
    });
    
});

// --------------------------querybuilder (tác động đến dữ liệu trong bảng)
Route::group(['prefix' => 'query-builder'], function () {
    //THêm 

    Route::get('add', function () {
        // Tạo 1 bản ghi
        // DB::table('users')->insert(
        //     [
        //     'email'=>'A@gmail.com',
        //     'password'=>'123456',
        //     'full'=>'Nguyễn văn A',
        //     'address'=>'Thường tín',
        //     'phone'=>'123456',
        //     'level'=>1
        //     ]
        // );

        //tạo nhiều bản ghi
          DB::table('users')->insert([
            ['email'=>'B@gmail.com','password'=>'123456','full'=>'Nguyễn văn B','address'=>'Thường tín','phone'=>'123456','level'=>1],
            ['email'=>'C@gmail.com','password'=>'123456','full'=>'Nguyễn văn C','address'=>'Thường tín','phone'=>'123456','level'=>2],
          ]
        );
    });


    // sửa
    Route::get('edit', function () {

        DB::table('users')->where('id',2)->update(
            ['email'=>'D@gmail.com','password'=>'123456','full'=>'Nguyễn văn D','address'=>'Bắc giang','phone'=>'123456','level'=>1]
        );
        
    });


    // xoá
    Route::get('del', function () {
        DB::table('users')->where('id','>=',2)->delete();
    });


    //Lấy toàn bộ bản ghi 
    route::get('get',function(){
        $users=DB::table('users')->get();
        
        foreach($users as $value)
        {
          
            echo $value->email."|".$value->password."<hr>";
        }
        // dd($users->toarray());
    });

    //Lấy bản ghi đầu tiên của câu lệnh truy vấn
    route::get('first',function(){
        $user=DB::table('users')->first();
        dd($user->email);
    });

    //Lấy các Cột cần Hiển thị
    route::get('select',function(){
        $users=DB::table('users')->select('email','password')->get();
        dd($users);
    });

    //where and
    Route::get('where-and', function () {
        // $users=DB::table('users')->where('id',9)->first();
        // $users=DB::table('users')->where('full','like','%th%')->get();
        $users=DB::table('users')->where('full','like','%th%')->where('password',"123456")->get();
        dd($users);
    });

    // where or
    Route::get('where-or', function () {
      
        $users=DB::table('users')->where('full','like','%th%')->orwhere('id',8)->get();
        dd($users);
    });

    // order by

    Route::get('orderby', function () {
      
        $users=DB::table('users')->where('full','like','%th%')->orderby('id','desc')->get();
        dd($users);
      
    });

    // limit kết quả
    Route::get('limit', function () {
        //đứng từ bản ghi thứ nhất lấy 1 bản ghi tiếp theo
        $users=DB::table('users')->skip(1)->take(1)->get();
        dd($users);
    });
    
    //avg
    Route::get('avg', function () {
        //đứng từ bản ghi thứ nhất lấy 1 bản ghi tiếp theo
        $avg=DB::table('users')->where('full','like','%th%')->avg("id");
        dd($avg);
    });
    // tăng/giảm giá trị cột 
    Route::get('icrement', function () {
       //tăng cột level lên 4 đơn vị
        DB::table('users')->increment("level",4);
       
    });

    Route::get('decrement', function () {
         //giảm cột level lên 4 đơn vị
         DB::table('users')->decrement("level",4);
        
     });

    
});


// --------------model
Route::group(['prefix' => 'model'], function () {


    Route::get('add', function () {
        $name="Quần Nam 2018";
        $parent=3;
        $cate=new App\models\category;
        $cate->name=$name;
        $cate->slug=str_slug($name);
        $cate->parent=$parent;
        $cate->save();
        //lấy id vừa thêm
        echo "bạn vừa thêm id là:".$cate->id;
    });

    Route::get('edit', function () {
        $name="Quần Nam 2019";
        $parent=3;
        //Chú ý: Tìm theo khoá chính được khai báo trong model (mặc định là id)
        $cate=App\models\category::find(9);
        $cate->name=$name;
        $cate->slug=str_slug($name);
        $cate->parent=$parent;
        $cate->save();

    });


    Route::get('del', function () {
        //xoá 1
        //Chú ý: xoá theo khoá chính được khai báo trong model (mặc định là id)
        App\models\category::destroy(9);

        // Xoá nhiều
        // App\models\category::destroy([9,8]);
    });
    
});
// renationship
Route::group(['prefix' => 'lienket'], function () {
    //Liên kết 1-n
    Route::get('lk1-n-thuan', function () {
        $data=App\models\category::find(2)->product()->get()->toarray();
        dd($data);
    });

    //Liên kết 1-1 chiều nghịch

    Route::get('lk1-1-nghich', function () {
        $data=App\models\product::find(2)->category()->first()->toarray();
        dd($data);
    });
});

//session
Route::group(['prefix' => 'session'], function () {
       //khởi tạo session
        Route::get('create-session', function () {
            session()->put('ten','Dinh Van Thien');
            session()->put('year','2019');
            echo "Đã khởi tạo session";
            
    });   

    //Hiển thị nội dung session

    Route::get('show-session', function () {
        echo session('ten');
        echo '<br>';
        echo session('year');
    });

    // Xóa session
    Route::get('del-session',function(){
        // Xóa 1 session
        Session()->forget('ten');
        // Xóa toàn bộ session
        session()->flush();
    });
   // Kiểm tra sự tồn tại
    Route::get('exists', function () {
        if(session()->has('ten')){
            echo "tồn tại session ten";
        }
        else {
            echo 'không tông tại session ten';
        }
    });


});
//Project

// creator
Route::get('', 'creator\HomeController@GetIndex');
Route::get('about', 'creator\HomeController@GetAbout');
Route::get('contact','creator\HomeController@GetContact');
Route::get('{slug_cate}.html', 'creator\HomeController@GetPrdCate');
Route::get('filter', 'creator\HomeController@GetFilter'); 



    Route::group(['prefix' => 'cart'], function () {
        Route::get('','creator\CartController@GetCart');
        Route::get('add','creator\CartController@AddCart');
        Route::get('update/{rowId}/{qty}','creator\CartController@UpdateCart');
        Route::get('del/{rowId}','creator\CartController@DelCart');

    });

    Route::group(['prefix' => 'checkout'], function () {
        Route::get('','creator\CheckOutController@GetCheckout');
        Route::post('','creator\CheckOutController@PostCheckout');
        Route::get('complete/{order_id}','creator\CheckOutController@GetComplete');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('shop','creator\ProductController@GetShop');
        Route::get('{slug_prd}.html', 'creator\ProductController@GetDetail');
    });



//admin
Route::get('login','admin\LoginController@GetLogin')->middleware('CheckLogout');
Route::post('login','admin\LoginController@PostLogin');

Route::group(['prefix' => 'admin','middleware'=>'CheckLogin'], function () {
    
    Route::get('','admin\HomeController@GetIndex');
    Route::get('logout','admin\HomeController@Logout');
   
    //category
    Route::group(['prefix' => 'category'], function () {
        Route::get('','admin\CategoryController@GetCategory');
        Route::post('','admin\CategoryController@PostCategory');
        Route::get('edit/{cate_id}','admin\CategoryController@GetEditCategory');
        Route::post('edit/{cate_id}','admin\CategoryController@PostEditCategory');
        Route::get('del/{cate_id}','admin\CategoryController@DelCategory');
    });


    //product
    Route::group(['prefix' => 'product'], function () {
        Route::get('','admin\ProductController@GetListProduct');
        Route::get('add', 'admin\ProductController@GetAddProduct');
        Route::post('add', 'admin\ProductController@PostAddProduct');
        Route::get('edit/{prd_id}', 'admin\ProductController@GetEditProduct');
        Route::post('edit/{prd_id}', 'admin\ProductController@PostEditProduct');
        Route::get('del/{prd_id}', 'admin\ProductController@GetDelProduct');
        
    });

    //user
    Route::group(['prefix' => 'user'], function () {
        Route::get('','admin\UserController@GetListUser');
        Route::get('add','admin\UserController@GetAddUser');
        Route::post('add','admin\UserController@PostAddUser');
        Route::get('edit/{id_user}', 'admin\UserController@GetEditUser');
        Route::post('edit/{id_user}', 'admin\UserController@PostEditUser');
        Route::get('del/{id_user}', 'admin\UserController@DelUser');
    });


    //order
    Route::group(['prefix' => 'order','middleware'=>'CheckAdmin'], function () {
        Route::get('','admin\OrderController@GetOrder');
        Route::get('detail/{order_id}','admin\OrderController@GetDetailOrder');
        Route::get('paid/{order_id}','admin\OrderController@Paid');
        Route::get('processed','admin\OrderController@GetProcessed');
    });
   
});

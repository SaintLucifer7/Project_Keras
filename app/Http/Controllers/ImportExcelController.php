<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;

class ImportExcelController extends Controller
{
    function index(){
        $data = DB::table('products')->orderBy('id', 'DESC')->get();
        return view('import_excel', compact('data'));
    }

    function import(Request $request)
    {
     $this->validate($request, [
      'select_file'  => 'required|mimes:xls,xlsx'
     ]);

     $path = $request->file('select_file')->getRealPath();

     $data = Excel::import(new ProductImport, $path);

    //  if($data->count() > 0)
    //  {
    //   foreach($data->toArray() as $key => $value)
    //   {
    //    foreach($value as $row)
    //    {
    //     $insert_data[] = array(
    //      'id'  => $row['id'],
    //      'name'   => $row['name'],
    //      'price'   => $row['price'],
    //      'stock'    => $row['stock'],
    //      'description'  => $row['description'],
    //      'location'   => $row['location']
    //     );
    //    }
    //   }

    //   if(!empty($insert_data))
    //   {
    //    DB::table('tbl_customer')->insert($insert_data);
    //   }
    //  }
     return back()->with('success', 'Excel Data Imported successfully.');
    }
}

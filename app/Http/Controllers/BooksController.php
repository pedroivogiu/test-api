<?php

namespace App\Http\Controllers;

use App\Models\Books;
Use stdClass;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    
    public function findAll(Request $request)
    {

        try{
            $reqPage = (int) $request->get('page');
            $reqItems = (int) $request->get('perPage');

            $page = ($reqPage> 1) ? $reqPage : 1;
            $numberOfLines= ($reqItems > 1) ? $reqItems : 10;

            $result = Books::findAll($page,$numberOfLines);

            $dataObject = new stdClass();
            $dataObject->page = $page;
            $dataObject->items_per_page = $numberOfLines;

            $result[] = $dataObject;

            return response()->json($result, 200);
        } catch (Exception $e){
            return response()->json("Please use valid parameters", 400);
        }
    }

    public function findBook($id)
    {
        $Respose = Books::find($id);
        if(is_object($Respose)){
            return response()->json($Respose);
        }else{
            return response()->json("Book not found", 404);
        }
        
    }

    public function findBookByAuthor($name)
    {
        $Respose = Books::findByAuthor($name);
        if(count($Respose) >= 1){
            return response()->json($Respose);
        }else{
            return response()->json("Author's Books not found", 404);
        }
    }
}
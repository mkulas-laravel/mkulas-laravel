<?php

namespace App\Http\Controllers;

use App\Models\Nameday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function search(Request $request){

        if($request->ajax()) {
            $data = DB::table('namedays')->where('names', 'LIKE', '%'.$request->names.'%')->limit('5')
                ->get();
            $output = '';

            if (count($data)>0) {
                foreach ($data as $row){
                    $output .= '<li><a href="'.$row->id.'">'.$row->names.'</a></li>';
                }
            }
            else {
                $output .= '<li>'.'Žiadna zhoda. Možno preklep ? '.'</li>';
            }
        }
        return $output;
    }
}

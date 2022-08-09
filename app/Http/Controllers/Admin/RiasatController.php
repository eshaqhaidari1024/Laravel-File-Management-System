<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Riasat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class RiasatController extends Controller
{

    public function index($id=null)
    {

        if(isset($id) && $id >0){

            $riasats=\DB::table('riasats')->paginate($id);
        }else{

            $riasats=\DB::table('riasats')->paginate(10);
        }


        return view('riasat.index',compact('riasats'))->with(['panel_title'=>'لیست ریاست','route'=>route('riasat.list')]);
    }

    public function create(Request  $request)
    {


        if($request->isMethod('get')){


            return view('riasat.form')->with(['panel_title'=>'ایجاد ریاست']);

        }else{


            $validator =Validator::make($request->all(),[

                'name'=>'required',
            ]);

            if($validator->fails()){

                return  array(
                    'fail'=>true,
                    'errors'=>$validator->getMessageBag()->toArray(),
                );
            }else{




                if(\App\Models\Riasat::where('name',$request->get('name'))->exists()){

                    return array(
                        'exist'=>true,
                    );
                }else{
                    $riasat=new Riasat();
                    $riasat->name=$request->get('name');
                    $riasat->save();
                    return  array(
                        'content'=>'content',
                        'url'=>route('riasat.list'),
                    );

                }


            }




        }
    }

    public function update(Request  $request , $id)
    {
        $riasat=Riasat::find($id);


        if($request->isMethod('get')){


            return view('riasat.form',compact('riasat'))->with(['panel_title'=>'ویرایش ریاست']);
        }else{

            $validator=Validator::make($request->all(),[
                'name'=>'required',
            ]);
            if($validator->fails()){


                return  array(
                    'fail'=>true,
                    'errors'=>$validator->getMessageBag()->toArray(),
                );
            }else{


                $riasat->name=$request->get('name');
                $riasat->save();
                Session::put('msg_status', true);

                return  array(
                    'content'=>'content',
                    'url'=>route('riasat.list'),
                );
            }
        }

    }

    public function delete( $id)
    {

        $riasat=Riasat::find($id);


        $riasat->delete();


        return redirect()->route('riasat.list')->with('success','به صورت موفقانه حذف گردید');
    }

}

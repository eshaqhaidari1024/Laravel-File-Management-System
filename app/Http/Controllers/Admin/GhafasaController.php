<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ghafasa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class GhafasaController extends Controller
{

    public function index($id=null)
    {

        if(isset($id) && $id >0){

            $ghafas=\DB::table('ghafasas')->paginate($id);
        }else{

            $ghafas=\DB::table('ghafasas')->paginate(10);
        }


        return view('ghafasa.index',compact('ghafas'))->with(['panel_title'=>'لیست بخش ها','route'=>route('ghafasa.list')]);
    }

    public function create(Request  $request)
    {
        if($request->isMethod('get')){


            return view('ghafasa.form')->with(['panel_title'=>'ایجاد قفسه']);

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




                if(Ghafasa::where('name',$request->get('name'))->exists()){

                    return array(
                        'exist'=>true,
                    );
                }else{
                    $ghafasa=new Ghafasa();
                    $ghafasa->name=$request->get('name');
                    $ghafasa->save();
                    return  array(
                        'content'=>'content',
                        'url'=>route('ghafasa.list'),
                    );

                }


            }




        }
    }

    public function update(Request  $request , $id)
    {
        $ghafasa=Ghafasa::find($id);


        if($request->isMethod('get')){


            return view('ghafasa.form',compact('ghafasa'))->with(['panel_title'=>'ویرایش قفسه']);
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


                $ghafasa->name=$request->get('name');

                $ghafasa->save();
                Session::put('msg_status', true);

                return  array(
                    'content'=>'content',
                    'url'=>route('ghafasa.list'),
                );
            }
        }

    }

    public function delete( $id)
    {

        $ghafasa=\App\Models\Ghafasa::find($id);


        $ghafasa->delete();


        return redirect()->route('ghafasa.list')->with('success','به صورت موفقانه حذف گردید');
    }
}

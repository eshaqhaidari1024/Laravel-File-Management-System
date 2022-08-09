<?php


function countLetter($type){


}

function theBiggestLetter(){

    $letter=\Illuminate\Support\Facades\DB::table('letter');

    $letters=array(
        countLetter('صادره'),
        countLetter('وارده'),
        countLetter('استعلام'),
        countLetter('پیشنهاد'),
    );
    return max($letters);
}
function getUserName($id){

if(isset($id)){

    $username=    \Illuminate\Support\Facades\DB::table('users')->select('name','last_name')->where('id',$id)
        ->first();

    return  $username->name . ' ' . $username->last_name;
}




return  '';

}

function getPsdFiles($download_links, $orginal_name){

    return $download_links.''.$orginal_name;
}

function getDepName($id){

    $dep=\App\Models\ArchDepartment::find($id);


    return  $dep->dep_name;
}
function getRiasat($id)
{


if(isset($id)){

    $data=\App\Models\Riasat::find($id);
    return $data->name;
}




}

function getDepartments($id){

    if(isset($id)){

        $dep=\App\Models\ArchDepartment::find($id);

        return $dep->dep_name;
    }
}

function getOriginalName($name){

    if($name){

        $name=explode('.',$name)[0];
    }

    return $name;
}

function getGhafasa($gh_id){

    if(isset($gh_id)){

        $ghafas=\App\Models\Ghafasa::find($gh_id);
        return  $ghafas->name;


    }

}





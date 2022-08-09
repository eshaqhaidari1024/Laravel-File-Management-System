<h4 class="box-title">
    {{isset($panel_title) ?$panel_title :''}}
</h4>
<div class="col-md-6 col-md-offset-3">
    <form method="post" id="frm" action="{{isset($riasat) ? route('riasat.update',$riasat->id) : route('riasat.create')}}" enctype="multipart/form-data">
        {{ isset($riasat) ? method_field('put') :''  }}
        {{csrf_field()}}


        <div class="form-group required " id="form-name-error">
            <label for="name">نام ریاست:*</label>
            <input type="text" class="form-control required" id="name" name="name" value="{{old('name',isset($riasat) ? $riasat->name :'')}}">
            <span class="help-block" id="name-error"></span>
        </div>


        <div class="form-group ">
            <button type="submit" id="btn_save" class="btn btn-primary">ثبت اطلاعات</button>
            <a href="javascript:ajaxLoad('{{route('riasat.list')}}')" class="btn btn-danger">لغو</a>
        </div>
    </form>
</div>

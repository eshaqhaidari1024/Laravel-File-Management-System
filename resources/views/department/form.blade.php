<h4 class="box-title">
    {{isset($panel_title) ?$panel_title :''}}
</h4>
<div class="col-md-6 col-md-offset-3">
    <form method="post" id="frm" action="{{isset($department) ? route('dep.update',$department->id) : route('dep.create')}}" enctype="multipart/form-data">
        {{ isset($department) ? method_field('put') :''  }}
        {{csrf_field()}}


        <div class="form-group required " id="form-arch-dep-error">
            <label for="arch-dep">نام مدیریت:*</label>
            <input type="text" class="form-control required" id="arch-dep" name="arch-dep" value="{{old('arch-dep',isset($department) ? $department->dep_name :'')}}">
            <span class="help-block" id="arch-dep-error"></span>
        </div>


        <div class="form-group  required" id="form-riasat-name-error">
            <label for="riasat-name">ریاست:*</label>
            <select name="riasat-name" id="riasat-name" class="form-control required">
                <option value="" disabled selected>ریاست را انتخاب کنید:</option>
                @foreach($riasats as $riasat)

                    <option value="{{$riasat->id}}" {{isset($department) && $department->riasat_id==$riasat->id ? 'selected="selected"':''}}>{{$riasat->name}}</option>
                @endforeach

            </select>
            <span id="riasat-name-error" class="help-block"></span>
        </div>


        <div class="form-group ">
            <button type="submit" id="btn_save" class="btn btn-primary">ثبت اطلاعات</button>
            <a href="javascript:ajaxLoad('{{route('dep.list')}}')" class="btn btn-danger">لغو</a>
        </div>
    </form>
</div>

<script>
    $(document).ready(function () {

        $('#riasat-name').select2();
    })
</script>

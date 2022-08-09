

<h4 class="box-title">
    {{isset($panel_title) ?$panel_title :''}}
</h4>
<div class="col-md-12 col-md-offset-3">
    <form method="post" id="frm" action="{{isset($letter) ? route('letter.update',$letter->id) : route('letter.create')}}" enctype="multipart/form-data">
            {{ isset($letter) ? method_field('put') :''  }}
        {{csrf_field()}}
        <div class="col-md-6">
            <div class="form-group  required" id="form-riasat-name-error">
                <label for="riasat-name">ریاست:*</label>
                <select name="riasat-name" id="riasat-name" class="form-control required">
                    <option value="" disabled selected>ریاست را انتخاب کنید:</option>
                    @foreach($riasats as $riasat)
                        <option value="{{$riasat->id}}" {{isset($letter) && $letter->riasat_id==$riasat->id ? 'selected="selected"':''}}>{{$riasat->name}}</option>
                    @endforeach

                </select>
                <span id="riasat-name-error" class="help-block"></span>
            </div>

            <div class="form-group  required" id="form-dep-name-error">
                <label for="dep-name">انتخاب مدیریت:*</label>
                <select name="dep-name" id="dep-name" class="form-control required">
                    <option value="" disabled selected>مدیریت را انتخاب کنید:</option>

                    @if(isset($letter))

                        <option value="{{$letter->department_id}}" selected="selected">{{getDepName($letter->department_id)}}</option>

                        @endif



                </select>
                <span id="dep-name-error" class="help-block"></span>
            </div>

            <div class="form-group  required" id="form-arch-type-error">
                <label for="ghafasa">قفسه:*</label>
                <select name="ghafasa" id="ghafasa" class="form-control required">
                    <option value="" disabled selected>قفسه را انتخاب کنید:</option>
                    @foreach($ghafas as $ghafa)
                        <option value="{{$ghafa->id}}" {{isset($letter) && $letter->ghafas_id==$ghafa->id ? 'selected="selected"':''}}>{{$ghafa->name}}</option>
                    @endforeach

                </select>
                <span id="ghafasa-error" class="help-block"></span>
            </div>

            <div class="form-group  required" id="form-dosia-error">
                <label for="dosia">نمبر دوسیه:*</label>
                <select name="dosia" id="dosia" class="form-control required">
                    <option value="" disabled selected>نمبر دوسیه را ا نتخاب کنید:</option>
                   <option value="1">1</option>
                   <option value="2">2</option>
                   <option value="3">3</option>
                   <option value="4">4</option>
                   <option value="5">5</option>
                   <option value="6">6</option>
                   <option value="7">7</option>
                   <option value="8">8</option>
                   <option value="9">9</option>
                   <option value="10">10</option>
                   <option value="11">11</option>
                   <option value="12">12</option>
                    </select>
                <span id="dosia-error" class="help-block"></span>
            </div>

            <div class="form-group required " id="form-name-error">
                <label for="name">نام:</label>
                <input type="text" class="form-control required" id="name" name="name" value="{{old('name',isset($letter) ? $letter->name:'')}}">
                <span class="help-block" id="name-error"></span>
            </div>

            <div class="form-group required " id="form-last-name-error">
                <label for="last-name">نام پدر:</label>
                <input type="text" class="form-control required" id="last-name" name="last-name" value="{{old('last-name',isset($letter) ? $letter->last_name:'')}}">
                <span class="help-block" id="last-name-error"></span>
            </div>
            <div class="form-group  required" id="form-arch-date-error">
                <label for="arch-date">تاریخ:*</label>
                <input type="text" class="form-control required" id="arch-date" name="arch-date" value="{{old('arch-date',isset($letter) ? $letter->arch_date:'')}}" autocomplete="off">
                <span class="help-block" id="arch-date-error"></span>
            </div>


        </div>

       <div class="col-md-6">

           <div class="form-group required " id="form-arch-date-register-error">
               <label for="arch-date-register">تاریخ راجستر:*</label>
               <input type="text" class="form-control required" id="arch-date-register" name="arch-date-register" value="{{\Morilog\Jalali\Jalalian::now()}}" autocomplete="off">
               <span class="help-block" id="arch-date-register-error"></span>
           </div>
           <div class="form-group required " id="form-arch-no-error">
               <label for="arch-no">نمبر آرشیف:</label>
               <input type="text" class="form-control required" id="arch-no" name="arch-no" value="{{old('arch-no',isset($letter) ? $letter->arch_no:'')}}">
               <span class="help-block" id="arch-no-error"></span>
           </div>
           <div class="form-group required " id="form-arch-letter-no-error">
               <label for="arch-letter-no">نمبر مکتوب:</label>
               <input type="text" class="form-control required" id="arch-letter-no" name="arch-letter-no" value="{{old('arch-letter-no',isset($letter) ? $letter->arch_letter_no:'')}}">
               <span class="help-block" id="arch-letter-no-error"></span>
           </div>
           <div class="form-group required " id="form-arch-title">
               <label for="arch-title"> موضوع/خلص مطلب:*</label>
               <input type="text" class="form-control required" id="arch-title" name="arch-title" value="{{old('arch-title' , isset($letter) ? $letter->arch_title:'')}}">
               <span class="help-block" id="arch-title-error"></span>
           </div>
           <div class="form-group required ">

               <label class="control-label" for="name">عکس مکتوب</label>
               <br>

               @if(isset($edit))

                   @foreach(json_decode($letter->arch_photo,true) as $image)

                       <div class="img_settings_container" data-field-name="arch-photo" style="float:right;padding-right:15px;" >
                           <a href="javascript:void(0)" class="voyager-x remove-multi-image" data-idname="{{$image['download_link']}}" style="position: absolute;"  data-id="{{$letter->id}}" ></a>
                           <img src="{{asset('storage/images/letter/'.$image['download_link'])}}" data-download-link="{{$image['download_link']}}" style="max-width:200px; height:auto; clear:both; display:block; padding:2px; border:1px solid #ddd; margin-bottom:5px;" data-original-name="{{$image['original_name']}}">
                       </div>

                   @endforeach
                   <div class="clearfix"></div>
                   <input type="file" name="arch-photo[]" multiple="multiple">


               @else
                   <input type="file" name="arch-photo[]" multiple="multiple" >
               @endif

           </div>
{{--           <div class="form-group required " id="form-arch-from-error">--}}
{{--               <label for="arch-from">مرسل:*</label>--}}
{{--               <input type="text" class="form-control required autocomplete_txt" data-field-name="dep_name" id="arch-from" autocomplete="off" name="arch-from" value="{{old('arch-from',isset($letter) ? $letter->arch_from:'')}}">--}}
{{--               <span class="help-block" id="arch-from-error"></span>--}}
{{--           </div>--}}
{{--           <div class="form-group required " id="form-arch-to-error">--}}
{{--               <label for="arch-to">مرسل علیه:*</label>--}}
{{--               <input type="text" class="form-control required autocomplete-text" data-field-name="dep_name" id="arch-to" name="arch-to" value="{{old('arch-to',isset($letter) ? $letter->arch_to:'')}}" autocomplete="off">--}}
{{--               <span class="help-block" id="arch-to-error"></span>--}}
{{--           </div>--}}
           {{--        <div class="form-group required " id="form-arch-ejraat-error">--}}
           {{--            <label for="arch-ejraat">اجراات:*</label>--}}
           {{--            <input type="text" class="form-control required" id="arch-ejraat" name="arch-ejraat" value="{{old('arch-ejraat',isset($letter) ? $letter->arch_ejraat:'')}}">--}}
           {{--            <span class="help-block" id="arch-ejraat-error"></span>--}}
           {{--        </div>--}}

           <div class="form-group ">
               <button type="submit" id="btn_save" class="btn btn-primary">ثبت اطلاعات</button>
               <a href="javascript:ajaxLoad('{{route('letter.list')}}')" class="btn btn-danger">لغو</a>
           </div>
       </div>
    </form>
</div>


<style>
    .voyager-x:before {
        content: "x";
        margin-right: 4px;
        font-weight: bold;
        background-color: #1d5d7b !important;
        color: #ffff;
        padding: 0px 6px;
        position: relative;
        position: fixed;
        margin-top: 3px;
    }
</style>

<script type="text/javascript">



/*        var currDate = '';
    function initWork() {
        //Today

        // get today's date in Hijri
        currDate = HijriJS.today().toString();
        // to remove H from yearH ex: 1440H, drop the last character to be 1440
        currDate = currDate.substring(0, currDate.length - 1);
        // reformat date from dd/mm/yyyy to dd-mm-yyyy
        currDate = currDate.split('/').join('-');
        // set the date input field to currDate so, datepicker sets it as the current date automatically
        $('#arch-date').val(currDate);
        $('#arch-date-register').val(currDate);
    }*/
   /* $( function() {
        $( "#arch-date" ).datepicker({
            changeMonth: true, // show months menu
            changeYear: true, // show years menu
            dayNamesMin: [ "س", "ج", "خ", "ر", "ث", "ن", "ح" ], // arabic days names
            dateFormat: "dd-mm-yy", // set format to dd-mm-yyyy
            monthNames: [ "محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة" ],
            yearRange: "c-0:c+15", // year range in Hijri from current year and +15 years
            monthNamesShort: [ "محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة" ],
            showAnim: 'fadeIn'
        });

        $( "#arch-date-register" ).datepicker({
            changeMonth: true, // show months menu
            changeYear: true, // show years menu
            dayNamesMin: [ "س", "ج", "خ", "ر", "ث", "ن", "ح" ], // arabic days names
            dateFormat: "dd-mm-yy", // set format to dd-mm-yyyy
            monthNames: [ "محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة" ],
            yearRange: "c-0:c+15", // year range in Hijri from current year and +15 years
            monthNamesShort: [ "محرم", "صفر", "ربيع الأول", "ربيع الثاني", "جمادى الأول", "جمادى الثاني", "رجب", "شعبان", "رمضان", "شوال", "ذو القعدة", "ذو الحجة" ],
            showAnim: 'fadeIn'
        });
    });*/
    $(document).ready(function () {

        kamaDatepicker('arch-date',{
            buttonsColor: "red",
            forceFarsiDigits: true ,
            markToday:true,
            gotoToday:true,
        });
        // kamaDatepicker('arch-date-register');

        $('#riasat-name').select2();
        $('#dep-name').select2();
        $('#ghafasa').select2();

        function registerEvent() {
            $(document).on('click','.voyager-x', removeImage);
            $(document).on('change','#riasat-name',riasatName);


        }
        registerEvent();
    })
    function removeImage(event) {

        event.stopPropagation();
        event.stopImmediatePropagation();
        if(confirm('آیا حذف شود؟')){
            var click=$(this).parent();
            var download_link=event.target.nextElementSibling.dataset.downloadLink;
            var original_name=event.target.nextElementSibling.dataset.originalName;
            var id=event.target.dataset.id;
            var container=event.target.parentElement;
            $.ajax({
                method:'post',
                url:'{{route('letter.removeImage')}}',
                cache:false,
                data:{
                    id:id,
                    download_link:download_link,
                    original_name:original_name,
                    _token:'{{csrf_token()}}',
                },
                success:function (res) {

                    if(res.file_deleted==true){

                        click.hide();



                    }else if(res.file_null==true){

                        $('#form-arch-photo-error').css('display','block');

                    }
                },
                error:function (res) {

                }

            });
        }else{

            return;
        }

    }

    function riasatName(event){
        event.stopPropagation();
        event.stopImmediatePropagation();
        var id=$(this).val();


        $.ajax({
            method:'get',
            url:'{{route('letter.riasat_name')}}',
            cache:false,
            data:{
                id:id,
                _token:'{{csrf_token()}}',
            },
            success:function (res) {

                var html='';

                $.each(res.data, function(index, value) {

                  html+='<option value="'+value.id+'">'+value.dep_name+'</option>';

                });

                $('#dep-name').html(html);
            },
            error:function (res) {

            }

        });

    }




</script>

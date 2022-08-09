
<div class="col-md-12" id="print-area">
    <h4 style="text-align: center" id="title">
        {{isset($panel_title) ?$panel_title :''}}
    </h4>
    <div class="row margin-bottom-10">
        <div class="col-md-4">
            <div class="letter-details">
                <div>
                    <p class="arch-title">مضمون</p>
                    <p class="arch-detail">{{$singleLetter->arch_title}}</p>
                </div>
                <div>
                    <p class="arch-title">ریاست</p>
                    <p class="arch-detail">{{getRiasat($singleLetter->riasat_id)}}</p>
                </div>
                <div>
                    <p class="arch-title">مدیریت/آمریت</p>
                    <p class="arch-detail">{{getDepName($singleLetter->department_id)}}</p>
                </div>
                <div>
                    <p class="arch-title">تاریخ مکتوب</p>
                    <p class="arch-detail">{{$singleLetter->arch_date}}</p>
                </div>
                <div>
                    <p class="arch-title">تاریخ راجستر</p>
                    <p class="arch-detail">{{$singleLetter->arch_date_register}}</p>
                </div>
                <div>
                    <p class="arch-title">نمبر آرشیف</p>
                    <p class="arch-detail">{{$singleLetter->arch_no}}</p>
                </div>
                <div>
                    <p class="arch-title">نمبر مکتوب</p>
                    <p class="arch-detail">{{$singleLetter->arch_letter_no}}</p>
                </div>
                <div>
                    <p class="arch-title">نمبر دوسیه</p>
                    <p class="arch-detail">{{$singleLetter->dosia}}</p>
                </div>

                <div>
                    <p class="arch-title">نمبر قفسه:</p>
                    <p class="arch-detail">{{getGhafasa($singleLetter->ghafas_id)}}</p>
                </div>

                <div>
                    <p class="arch-title">ویرایش توسط:</p>
                    <p class="arch-detail">{{getUserName($singleLetter->user_id)}}</p>
                </div>



                <div class="letter-button" style="border: none;margin-top: 30px">
{{--                    <a href="{{route('letter.download',$singleLetter->id)}}" class="btn  btn-primary btn-block"><i class="fa fa-download " ></i></a>--}}
                    @if(explode('.',$singleLetter->arch_photo)[1]!=='pdf')
                    <button onclick="imprimir()" class="btn btn-info btn-block"><i class="fa fa-print"></i></button>
                        @endif

                </div>
            </div>
        </div>
        <div class="col-md-8 text-center">
            @if(explode('.',$singleLetter->arch_photo)[1]=='pdf')

                <span><i class="fa fa-file-pdf-o" style="font-size: 246px;
    margin-top: 220px;
    display: block;
color: #840909"></i></span>

                @else
             <div class="letter-image" id="print-image">


                    @foreach(json_decode($singleLetter->arch_photo,true) as $image)

                     <img src="{{asset('storage/images/letter/'.$image['download_link'])}}" alt="" title="{{$image['original_name']}}">
                        <b>{{getOriginalName($image['original_name'])}}</b>

                 @endforeach

             </div>
                @endif
        </div>
    </div>

    <style>
        .arch-title{
            display: inline;
            font-size: 16px;
            font-weight: 600;
            margin-left: 12px;

        }
        .arch-title:after{
            content: ':';
            margin-right: 4px;
            font-size: 16px;
            font-weight: 600;
        }
        .arch-detail{
            display: inline;
            font-size: 15px;
            font-weight: 500;
        }
        .letter-details div{
            border: 1px solid #eee;
            padding: 2px 4px 2px 4px;

        }
        .letter-details{
            margin-top: 200px;
        }


    </style>
    <script>


 $(document).ready(function () {



     $(".pagination a").unbind().bind("click",function (event) {
         event.preventDefault();

         $('li').removeClass('active');
         $(this).parent('li').addClass('active');

         var myurl = $(this).attr('href');

         ajaxLoad(myurl);




     });



 })



    </script>
</div>
<script type="text/javascript">
    function imprimir() {

        // var company = $("#company_id option:selected").text();

        var table = document.getElementById("print-image");
        var d = "<html><head>" +
            "<link rel='stylesheet' href='{{ asset("assets/plugin/bootstrap/css/bootstrap.min.css") }}' >" +
            "<style> th{text-align:right !important} th:last-child,td:last-child{display: none;} body{font-family:sahle}</style>"+
            "</head><body style='direction: rtl;font-family:sahel'>"+ table.innerHTML+"</body></html>";


        newWin = window.open();
        newWin.document.write(d);
        newWin.setTimeout(function () {

            newWin.print();
            newWin.close();
        },3000)



    }
</script>

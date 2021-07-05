<!DOCTYPE html>
<html>
<head>
  <title>Add Edit Delete Table Row Example using JQuery - ItSolutionStuff.com</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
</head>
<body>
    
<div class="container">
  <h1>Add Edit Delete Table Row Example using JQuery - ItSolutionStuff.com</h1>
  <br/>
  <table class="table table-bordered data-table">
    <thead>
      <th>Tên</th>
      <th>Email</th>
      <th>Số điện thoại</th>
      <th width="200px" class="text-center" style="cursor: pointer;">Action</th>
    </thead>
    @foreach($khachhang as $kh)
    <tbody >
    <tr data-name="{{$kh->khachhang_ten}}" data-email="{{$kh->khachhang_email}}">
      <td>{{$kh->khachhang_ten}}</td>
      <td>{{$kh->khachhang_email}}</td>
      <td>{{$kh->khachhang_sdt}}</td>
      <td class="text-center"><button class="btn btn-info btn-xs btn-edit">Edit</button></td>
    </tr>
    </tbody>
    @endforeach
  </table>
   
</div>
<input type="text" value="click a button">
 
 <script>
 $( "td" ).click(function() {
   var text = $( this ).text();
   $( "input" ).val( text );
 });
 </script>
<script type="text/javascript">
    // $('#thuntg').html('');
    $.get('{{url('bangg')}}', function(data){
        data.result.forEach(function(element){
            $('#thuntg').append(
				'<tr data-name="'+element.khachhang_ten+'" data-email="'+element.khachhang_email+'"><td class="text-center">'+element.khachhang_ten+'</td><td class="text-center" >'+element.khachhang_email+'</td><td class="text-center">'+element.khachhang_sdt+'</td><td class="text-center"><button class="btn btn-info btn-xs btn-edit">Edit</button></td></tr>'
			)
        })
});
    
    $("body").on("click", ".btn-edit", function(){
        var name = $(this).parents("tr").attr('data-name');
        var email = $(this).parents("tr").attr('data-email');
    
        $(this).parents("tr").find("td:eq(0)").html('<input name="edit_name" value="'+name+'">');
        $(this).parents("tr").find("td:eq(1)").html('<input name="edit_email" value="'+email+'">');
    
        $(this).parents("tr").find("td:eq(3)").prepend("<button class='btn btn-info btn-xs btn-update'>Update</button><button class='btn btn-warning btn-xs btn-cancel'>Cancel</button>")
        $(this).hide();
    });
   
    $("body").on("click", ".btn-cancel", function(){
        var name = $(this).parents("tr").attr('data-name');
        var email = $(this).parents("tr").attr('data-email');
    
        $(this).parents("tr").find("td:eq(0)").text(name);
        $(this).parents("tr").find("td:eq(1)").text(email);
   
        $(this).parents("tr").find(".btn-edit").show();
        $(this).parents("tr").find(".btn-update").remove();
        $(this).parents("tr").find(".btn-cancel").remove();
    });
   
    $("body").on("click", ".btn-update", function(){
        var name = $(this).parents("tr").find("input[name='edit_name']").val();
        var email = $(this).parents("tr").find("input[name='edit_email']").val();
    
        $(this).parents("tr").find("td:eq(0)").text(name);
        $(this).parents("tr").find("td:eq(1)").text(email);
     
        $(this).parents("tr").attr('data-name', name);
        $(this).parents("tr").attr('data-email', email);
    
        $(this).parents("tr").find(".btn-edit").show();
        $(this).parents("tr").find(".btn-cancel").remove();
        $(this).parents("tr").find(".btn-update").remove();
    });
    
</script>
     
</body>
</html>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Slider - Range slider</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#slider-range" ).slider({
      range: true,
      min: 0,
      max: 500,
      values: [ 75, 300 ],
      slide: function( event, ui ) {
        $( "#amount_start" ).val( ui.values[ 0 ] );
        $( "#amount_end" ).val( ui.values[ 1 ]);
      }
    });
    // $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) +
    //   " - $" + $( "#slider-range" ).slider( "values", 1 ) );
  } );
  </script>
</head>
<body>
 
<p>
  <label for="amount">Price range:</label>
  <input type="text" id="amount_start" name="start_price">
  <input type="text" id="amount_end" name="end_price" >
</p>
 
<div id="slider-range"></div>
<button onclick="send()">Click me</button>
<div id="showDiv"><div id="showPrice"></div></div>
 <script>
 function send(){
   var start = $('#amount_start').val();
   var end = $('#amount_end').val();
   $.ajax({
     method:"get",url:'{{ url('demo') }}',data: "start=" +start "& + end=" +end,
     beforeSend: function(){
       $('#showPrice').show("fast");

     }
     complete: function(){
       $('#showPrice').hide("fast");
     }
     success: function(html){
      $('#showDiv').show("slow");
      $('#showDiv').html(html);
     }
   })
 }
 </script>
 
</body>
</html>
<!DOCTYPE html>

<html>

<head>

      <meta name="viewport" content="width=device-width, initial-scale=1.0" charset="utf-8"  />

    <!-- style sheet for default theme(flat azure) -->

    <link href=" http://cdn.syncfusion.com/js/web/flat-azure/ej.web.all-latest.min.css" rel="stylesheet" />

    <!--scripts-->

    <script src="http://code.jquery.com/jquery-1.10.2.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/globalize/0.1.1/globalize.min.js"></script>

    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <script src="http://cdn.syncfusion.com/js/web/ej.web.all-latest.min.js"></script>
    
<script type="text/javascript">

$(function () {

      // document ready

// simple time picker creation


       $(".time").ejTimePicker();
	   
});

</script>

</head>

<body>

    <!-- add time picker element here -->
<table>

   

     <tr>

     

       <td class="tdclass">

            

                 
                  
                   <input class="time" type="text" />

             

       </td>

         <td class="tdclass">

         

                  
                   <input class="time" type="text" />
                   
                   

            

       </td>

   </tr>

 

</table>
</body>

</html>
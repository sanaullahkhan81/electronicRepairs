
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
    body{
        background: gray;
       
        margin:0 auto;
        font-size: 13px;
        font-weight: bold;
        
        
    }
    .printContent{
        
/*        width:7.18cm;
        height:2cm;*/
        background: white;     
             
        
       
        
    }
    #smallfont{
        font-size: 10px;
    }
   
 
@media print {
    #completa{
        display: none !important;
    }
    
    html, body{
        
        height:2cm !important;
    }
    
    .printtable:last-child{
         page-break-after: auto;
        
    }
    #smallfont{
        font-size: 8px;
    }
}


    </style>
    
   
    </head>
    <body>
      
            
<table class="printtable printContent" style="width:100%; padding:2px;">
  <tr>
    <th>Name</th>
    <td><b><?=$db['Nominativo'];?></b></td>
  </tr>
  <tr>
    <th>Description</th>
    <td> <b><?=$db['Guasto'];?></b></td>
  </tr>
  <tr>
    <th>Telephone:</th>
    <td><b><?=$db['Telefono'];?></b></td>
  </tr>
  <tr>
    <th> Pro Ref:</th>
    <td>  <b><?=$db['codice'];?></b></td>
  </tr>
  
</table>            
        <div style="clear:both;"></div>      
         
         
            
   

        
<button type="button" id="completa" class="btn btn-primary" onClick="window.print()"><i class="fa fa-print"></i> Print Label</button>
                   
 
    </body>

    


</html>


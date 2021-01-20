
<!DOCTYPE html>
 
 <html lang="en">
 <head>
 <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">  
 <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
 <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
 <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
 </head>
       <body>
          <div class="container">
             <table class="table table-bordered" id="modules_datatables">
                <thead>
                   <tr>
                      <th>Name</th>
                      <th>Api Name</th>

                       </tr>
                </thead>
             </table>
          </div>
    <script>
    $(document).ready( function () {
     $('#modules_datatables').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('users') }}",
            columns: [
                     { data: 'name', name: 'name' },
                     { data: 'api_name', name: 'api_name' },

                  ]
         });
      });
   </script>
    </body>
 </html> 
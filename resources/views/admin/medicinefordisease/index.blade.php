
@extends('layouts.adminMaster')
@section('title', "Medicine For Disease List")
@section('content')

@can('Diseasemedicine-Create') 
                
                        <div class="row">
                          <div class="col s12">
                              <div class="card">
                                  <div class="card-content">
                                    <div class="input-field col s12 m9">
                                      <form>
                                     
                                      <input placeholder="Search Any text" id="search" type="text" class="search-box validate white search-circle">
                                    </form>
                                  </div>
                                 
                                      
                                      <div class="col s12 m3 l3 input-field">
                                        
                                          <a href="{{url('admin/createdisemedicinelist')}}" class="waves-effect waves-light  btn "><i class="material-icons right">gps_fixed</i> Create New</a>
                                      </div>
                                     
                                      <div class="row">
                                          <div class="col s12">
                                              <table id="page-length-option" class="display responsive-table">
                                                  <thead>
                                              
                                                      <tr>
                                                         <td>SL</td>
                                                          <th>Date</th>
                                                          <th>Disease </th>
                                                         <th>Medicine (ওষুধ)</th>
                                                         <th>Edit</th>
                                                          <th>Delete</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                    @if(count($medicinefordisease)>0)
                                                    @foreach ($medicinefordisease as $medicine)
                                                       <tr>
                                                            <td>{{++$i}}</td>
                                                          <td>{{$medicine->created_at->diffForHumans()}}</td>
                                                          <td>{{$medicine->disease->diseasename}}</td>
                                                          <td>@foreach(json_decode($medicine->medicine) as $item)
                                                            {{ $item}}
                                                          @endforeach </td>
                                                         
                                                          
                                                         <td>
                                                          <a href="{{url('admin/editdisemedicinelist/'.$medicine->id) }}" class="btn-floating mb-1 waves-effect waves-light">
                                                            <i class="material-icons">edit</i>
                                                          </a>
                                                        </td>
                                                         
                                                            <td> {!! Form::open(['method' => 'DELETE','url' => ['admin/deletedisemedicinelist/'. $medicine->id],'onsubmit' => 'return confirm("are you sure ?")']) !!}
                                                              <button type="submit" class="btn-floating mb-1 waves-effect waves-light" >  <i class="material-icons">delete_forever</i></button>
                                                              {!! Form::close() !!} </td>
                                                              
                                                           
                                                          
                                                      </tr>
                                                     
                                                     
                                                  </tbody>
                                                  <tfoot>
                                                    @endforeach
                                                    @else
                                                   <h3 class="text-danger">Data Not Found</h3>
                                                   @endif
                                                  </tfoot>
                                              </table>
                                          {{ $medicinefordisease->links() }}
                                          </div>
                                         
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                 
                 
  <!-- Modal Structure -->
  <div id="SearchModal" class="modal">
    <div class="modal-content">
      <table class="table table-bordered table-hover">
        <thead>
        <tr>
        <th>ID</th>
       <th>Medicine </th>
       <th>Medicine (ওষুধ)</th>
        <th>Description</th>
       <th>Edit</th>
      </tr>
        </thead>
        <tbody id="dd">
        </tbody>
        </table>
    </div>
    <div class="modal-footer">
      <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>


  @endcan
@endsection

@section('page-script')

<script>
$(document).ready(function () {

  $('#search').on('keyup',function(){

function timer(){
  $search = $('#search').val();
  $.ajax({
          type: "post",
          url:url+'/admin/searchdisemedicinelist',
          data: {
              id:$search
             
          },
     
          success: function (data) {
            
            $('.modal').modal('open');
            $('#dd').html(data);
            $('#search').val(' ');
          }
     
      });
  }

//setTimeout(myFunc,5000);
setTimeout(timer,3000);   

});
  
  $("#approved").click(function(){
 
      $.ajax({
          type: "post",
          url:url+'/admin/medicinestatus',
          data: {
              id:$(this).attr('rid'),
              action:"allow"
          },
          dataType: "json",
          success: function (d) {
            swal({
    title: "Nice Work",
    text: "Disease De-Active Successfully",
    timer: 2000,
    buttons: false
  });
             location.reload();

          }
      });

  });

  $("#notapproved").click(function(){

      //console.log($roomid);
      $.ajax({
          type: "post",
          url:url+'/admin/medicinestatus',
          data: {
              id:$(this).attr('rid'),
              action:"deny"
          },
          dataType: "json",
          success: function (d) {
//             M.toast({
//     html: 'I am a toast!11'
// });
swal({
    title: "Nice Work",
    text: "Disease Active Successfully",
    timer: 2000,
    buttons: false
  });

              location.reload();

          }
      });

  });
});
</script>


@endsection
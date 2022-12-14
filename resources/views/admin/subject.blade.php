@extends('admin.layouts.layout-common')

@section('space-work')
      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">Subject page</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Add New Subject</button>
        <table class="table mt-5">
                <thead>
                    <tr>
                    <th scope="col">S.No</th>
                    <th scope="col">Subject Name</th>
                    <th scope="col">Status</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                    </tr>
                </thead>
                <tbody>
                  
                </tbody>
            </table>
      </div>
           
	</div>



 <!--Add Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add New Subject</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form id="addSubject">
                @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Subject Name </label>
                        <input type="text" class="form-control" name="subject" id="subject" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">Please Enter Subject Name</div>
                    </div>
             
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save Subject</button>
      </div>
    </div>
    </form>
  </div>
</div>



<script>
  function allSubjects(){
        $.ajax({
            url : "{{route('subjectList')}}",
            type : "GET",
            success : function(list){
              var data = "";
              $.each(list,function(key,value){
                data = data + "<tr>"
                data = data + "<td>"+value.id+"</td>"
                data = data + "<td>"+value.subject+"</td>"
                if(value.status == 1){
                  data = data + "<td><button class='btn btn-warning btn-sm'>Draft</button></td>"
                }
                else{
                  data = data + "<td><button class='btn btn-success btn-sm'>Publish</button></td>"
                }
                
                data = data + "<td>"
                data = data + "<button class='btn btn-info btn-sm onclick='editSubject("+value.id+")'>Edit</buton>"
                data = data + "</td>"
                data = data + "<td>"
                data = data + "<button class='btn btn-danger btn-sm' onclick='deleteSubject("+value.id+")'>Delee</buton>"
                data = data + "</td>"
                data = data + "</tr>"
              });
              $('tbody').html(data);
            }

        });
      }
 allSubjects();

    $(document).ready(function(){
        $('#addSubject').submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();

            $.ajax({
                url : '{{route("addSubject")}}',
                type : 'POST',
                dataType : 'json',
                data : formData,
                success:function(data){
                    if(data.success == true){
                        location.reload();
                    }
                    else{
                        alert(date.msg);
                    }
                }
            });
        });
    });

    function deleteSubject(id)
        {
          $.ajax({
                url:"/delete-subject/"+id,
                type:"GET",
                dataType : "json",
                success : function(data){
                    if(data.success == true){
                      allSubjects();
                    }
                }
        });
        
        }
        function editSubject(id)
        {
          $.ajax({
            url : "/edit/"+id,
            type : "GET",
            success : function(data){
              if(data.success == true){
                
              }
            }
          });
        }

</script>

@endsection
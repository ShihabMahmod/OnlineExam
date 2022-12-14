@extends('admin.layouts.layout-common')

@section('space-work')
      <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5 pt-5">
        <h2 class="mb-4">Exam Dashboard</h2>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" > Add New Subject</button>
        <table class="table mt-5">
                <thead>
                    <tr>
                    <th scope="col">E.No</th>
                    <th scope="col">Exam Name</th>
                    <th scope="col">Exam Subject</th>
                    <th scope="col">Exam Date</th>
                    <th scope="col">Exam Time</th>
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
        <h5 class="modal-title" id="exampleModalLabel">Add New Exam</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
            <form id="addExam">
                @csrf
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Exam Name </label>
                        <input type="text" class="form-control" name="exam_name" id="exam_name" >
                        <div id="emailHelp" class="form-text">Please Enter Subject Name</div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Subject Name </label>
                        <select name="subject" id="subject" class="form-control">
                          @foreach($subjectList as $list)
                              <option value="{{$list->id}}" id="subject">{{$list->subject}}</option>
                          @endforeach
                        </select>
                        <div id="emailHelp" class="form-text">Please Enter Subject Name</div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Exam Date</label>
                        <input type="date" class="form-control" name="date" id="date" required min="@php echo date('Y-m-d') @endphp">
                        <div id="emailHelp" class="form-text">Please Enter Subject Name</div>
                    </div>

                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Exam Duration </label>
                        <input type="time" class="form-control" name="time" id="time" required>
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
  function allExams(){
        $.ajax({
            url : "{{route('examList')}}",
            type : "GET",
            success : function(list){
              var data = "";
              $.each(list,function(key,value){
                data = data + "<tr>"
                data = data + "<td>"+value.id+"</td>"
                data = data + "<td>"+value.exam_name+"</td>"          
                data = data + "<td>"+value.subject_id+"</td>"         
                data = data + "<td>"+value.date+"</td>"
                data = data + "<td>"+value.time+"</td>"
                data = data + "<td>"
                data = data + "<button class='btn btn-info btn-sm' data-bs-toggle='modal' data-bs-target='#exampleModal' onclick='editExam("+value.id+")'>Edit</buton>"
                data = data + "</td>"
                data = data + "<td>"
                data = data + "<button class='btn btn-danger btn-sm' onclick='deleteExam("+value.id+")'>Delee</buton>"
                data = data + "</td>"
                data = data + "</tr>"
              });
              $('tbody').html(data);
            }

        });
      }
      allExams();

    $(document).ready(function(){
        $('#addExam').submit(function(e){
            e.preventDefault();
            var formData = $(this).serialize();
           
            $.ajax({
                url : '{{route("addExam")}}',
                type : 'POST',
                dataType : 'json',
                data : formData,
                success:function(data){
                    console.log(data);
                }
            });
        });
    });
    function deleteExam(id)
        {
          $.ajax({
                url:"/delete-exam/"+id,
                type:"GET",
                dataType : "json",
                success : function(data){
                    if(data.success == true){
                      allExams();
                    }
                }
        });
        
        }
        function editExam(id)
        {
          $.ajax({
            url : "/edit-exam/"+id,
            type : "GET",
            success : function(data){
              $('#exam_name').val(data.exam_name);
            }
          });
        }

</script>

@endsection
@extends('adminlte::page')

@section('title', 'Contactos')

@section('content_header')
    <h1>Contactos</h1>
@stop


@section('content')
@include('layouts/flash-message')
<section class="content">
    <div class="container-fluid">
      <div class="card">
          <div class="card-body">





    <div class="table-responsive table-bordered">
        <table id="listado_1" class="table" style="width: 100%;">

            <thead>
                <tr style="text-align: center;">
                    <th></th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Edad</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
        
            </tbody>
        </table>
    </div>




</div>
</div>

</div><!-- /.container-fluid -->
</section>


<div class="modal" id="deleteModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Eliminar</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Esta seguro que desea eliminar a este Contacto ?</p>
          <input type="hidden" id="input_modal" value="">
        </div>
        <div class="modal-footer">
          <button type="button" data-dismiss="modal" onclick="deleteEvent()" class="btn btn-success">SI</button>
          <button type="button" class="btn btn-danger" data-dismiss="modal">NO</button>
        </div>
      </div>
    </div>
  </div>


  <form action="" method="post" id="form_delete">
    @method('DELETE')
    {{ csrf_field() }}
  </form>


@stop
@section('js')
<script>

var route_delete = '{{url('contacto')}}';


$("#listado_1").DataTable({
  processing: true,
            serverSide: true,
            ajax: '{{ route('contact.serverside') }}',
            columnDefs: [{
                targets: [0, 1, 2],
                className: 'mdl-data-table__cell--non-numeric'
            }],
    "columns" : [
       { "data" : function(x){
          let img = x.image;
          return `<img src="{{asset('storage/foto')}}/${img}" alt="Foto" width="100">`;
        } },
       { "data" : "name" },
       { "data" : "last_name" },
       { "data" : 'email'},
       { "data" : "phone" },
       { "data" : function(x){
          return calcularEdad(x.birthday);
        } },
       { "data" : function(x){
           btn_edit = ` <a class="btn btn-warning btn-sm" href="{{url('/')}}/contacto/${x.id}/edit"  role="button"><svg class="bi bi-pen" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                   <path fill-rule="evenodd" d="M5.707 13.707a1 1 0 0 1-.39.242l-3 1a1 1 0 0 1-1.266-1.265l1-3a1 1 0 0 1 .242-.391L10.086 2.5a2 2 0 0 1 2.828 0l.586.586a2 2 0 0 1 0 2.828l-7.793 7.793zM3 11l7.793-7.793a1 1 0 0 1 1.414 0l.586.586a1 1 0 0 1 0 1.414L5 13l-3 1 1-3z"/>
                                   <path fill-rule="evenodd" d="M9.854 2.56a.5.5 0 0 0-.708 0L5.854 5.855a.5.5 0 0 1-.708-.708L8.44 1.854a1.5 1.5 0 0 1 2.122 0l.293.292a.5.5 0 0 1-.707.708l-.293-.293z"/>
                                   <path d="M13.293 1.207a1 1 0 0 1 1.414 0l.03.03a1 1 0 0 1 .03 1.383L13.5 4 12 2.5l1.293-1.293z"/>
                                 </svg></a>
                                 <button class="btn btn-danger btn-sm" onclick="deleteModal(${x.id})"  type="button">
                                       <svg width="1em" height="1em" viewBox="0 0 16 16" class="bi bi-x" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                       <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 0 1 0 .708l-7 7a.5.5 0 0 1-.708-.708l7-7a.5.5 0 0 1 .708 0z"/>
                                       <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 0 0 0 .708l7 7a.5.5 0 0 0 .708-.708l-7-7a.5.5 0 0 0-.708 0z"/>
                                       </svg>
                                 </button>`;
              return   btn_edit;                 
       }}
   ]
});


function calcularEdad(fechaNacimiento) {
        var hoy = new Date();
        var fechaNac = new Date(fechaNacimiento);
        var edad = hoy.getFullYear() - fechaNac.getFullYear();
        var mes = hoy.getMonth() - fechaNac.getMonth();

        // Verificar si aún no ha pasado el cumpleaños este año
        if (mes < 0 || (mes === 0 && hoy.getDate() < fechaNac.getDate())) {
            edad--;
        }

        return edad;
    }



function deleteModal(id){
    let route = route_delete+'/'+id
    $('#form_delete').prop('action',route);
    $('#deleteModal').modal('show');
}

function deleteEvent(){
    id = $('#form_delete').submit();
}

</script>
@stop
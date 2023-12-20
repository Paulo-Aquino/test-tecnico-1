@extends('adminlte::page')

@section('title', 'Editar Contactos')

@section('content_header')
    <h1>Editar Contactos</h1>
@stop


@section('content')
<section class="content">
    <div class="container-fluid">
        <div class="card">
            <div class="card-body">


                @if ($errors->any())
                <div class="alert alert-danger alert-dismissible">
                    <button type='button' class="close" data-dismiss="alert" aria-hidden="true">x</button>
                    <div class="alert-text">
                        @foreach ($errors->all() as $err)
                        <span>{{ $err }}</span>
                        @endforeach
                    </div>
                </div>

                @endif


                <form>
                   

    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Nombre</label>
                            <input type="text" class="form-control" id="name" value="{{old('name',$data->name)}}" name="name" minlength="3" maxlength="255"
                                placeholder="Nombre" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Apellido</label>
                            <input type="text" class="form-control" id="last_name" value="{{old('last_name',$data->last_name)}}" name="last_name" minlength="3" maxlength="255"
                                placeholder="Apellido" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Email</label>
                            <input type="email" class="form-control" id="email" name="email" minlength="5"
                                maxlength="255" placeholder="Email" value="{{old('email',$data->email)}}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Telefono</label>
                            <input type="number" class="form-control" id="phone" name="phone" minlength="5"
                                maxlength="255" placeholder="Telefono" value="{{old('phone',$data->phone)}}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Empresa</label>
                             <select class="form-control" id="company_id" name="company_id" required>
                                 @forelse ($company as $item)
                                 <option value="{{$item->id}}"  {{old('company_id',$data->company_id) == $item->id ? "selected":'' }} >{{$item->name}}</option>
                                 @empty
                                 <option disabled >Sin Empresa Disponible</option>
                                 @endforelse
                             </select>
                         </div>

                         <div class="form-group col-md-6">
                            <label>Fecha Creación</label>
                            <input type="text" class="form-control" id="website" name="website" minlength="5"
                                maxlength="255" placeholder="Website" value="{{date('d/m/Y H:i:s',strtotime($data->created_at))}}" readonly>
                        </div>

                        <div class="form-group col-md-6">
                            <label>Fecha Modificación</label>
                            <input type="text" class="form-control" id="website" name="website" minlength="5"
                                maxlength="255" placeholder="Website" value="{{date('d/m/Y H:i:s',strtotime($data->updated_at))}}" readonly>
                        </div>

                    </div>

               
                      <div class="form-row">

                       <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary">Enviar</button>
                       </div>
                    </div>

                    
                </form>




            </div>
        </div>



    </div><!-- /.container-fluid -->
</section>
@stop


@section('js')
<script>




</script>
@stop
<!DOCTYPE HTML>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8">
    </head>
    <body>
 
        <div class="row"> 
            <h1 class="subheader">Crear un post con laravel 4</h1>
            <!--si el formulario contiene errores de validación-->
            @if($errors->has())
                <div class="alert-box alert">           
                    <!--recorremos los errores en un loop y los mostramos-->
                    @foreach ($errors->all('<p>:message</p>') as $message)
                        {{ $message }}
                    @endforeach
                     
                </div>
            @endif

            <table>
                {{ Form::open(array('url' => 'crud/update/'.$post->id)) }}
                <tr>
                    <td>
                        {{ Form::label('title', 'Título') }}
                    </td>
                    <td>
                        {{ Form::text('title', Input::old('title') ? Input::old('title') : $post->title) }}
                    </td>
                </tr>

                <tr>
                    <td>
                        {{ Form::label('content', 'Post') }}
                    </td>
                    <td>
                         {{ Form::textarea('content', Input::old('content') ? Input::old('content') : $post->content) }}
                    </td>
                </tr>

                <tr>
                    <td>

                    </td>
                    <td>
                         {{ Form::submit('Crear post') }}
                    </td>
                </tr>              
 
                {{ Form::close() }}
 
            </table>    
             
        </div>
    </body>
</html>
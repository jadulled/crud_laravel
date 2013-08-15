<!DOCTYPE HTML>
<html lang="es-ES">
    <head>
        <meta charset="UTF-8">
        <title>Crud con laravel 4</title>
    </head>
    <body>
        <div class="row"> 
            <h1 class="subheader">Crud con laravel 4</h1>
            {{ HTML::link(URL::to('crud/create'), 'Crear un nuevo post') }}
             <ul>
            @if(count($posts) > 0)
           
                @foreach($posts as $post)

                    <li>
                        Título: {{ $post->title }}
                        Post: {{ $post->content }}
                        {{ HTML::link(URL::to('crud/update/'.$post->id), 'Actualizar post') }}
                        {{ HTML::link(URL::to('crud/delete/'.$post->id), 'Eliminar post') }}
                    </li>

                @endforeach
            
            @endif  
            </ul>   

            <!--mostramos mensajes conforme pasen acontecimientos-->
            @if(Session::has('mensaje'))
                <div>
                    {{ Session::get('mensaje') }}
                </div>
            @endif
        </div>
    </body>
</html>
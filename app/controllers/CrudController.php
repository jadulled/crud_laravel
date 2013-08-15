<?php

class CrudController extends BaseController
{

	//mostramos la vista index y enviamos un array con los posts que existan
	public function index()
	{

		$posts = Post::all();
		return View::make("index", array("posts" => $posts));

	}

	//método para crear un post, si se hace una petición post se ejecuta el
	//formulario, en otro caso se muestra la vista normal
	public function create()
	{
		//si es una petición post
		if(Input::get())
		{

			$inputs = $this->getInputs(Input::all());

			if($this->validateForms($inputs) === true)
			{

				 $post = new Post($inputs);

				 if($post->save())
				 {

				 	return Redirect::to('crud/show')->with(array('mensaje' => 'El post ha sido creado correctamente.'));

				 }

			}else{

				return Redirect::to('crud/create')->withErrors($this->validateForms($inputs))->withInput();

			}

		//si no es una petición post mostramos el formulario
		}else{

			return View::make("create");

		}

	}

	//método para actualizar un post, si se hace una petición post se ejecuta el
	//formulario, en otro caso se muestra la vista normal
	public function update($id)
	{

		$post = Post::find($id);//obtenemos el post que queremos actualizar o mostrar
		if(Input::get())
		{

			//si existe el post a editar lo hacemos
			if($post)
			{

				$inputs = $this->getInputs(Input::all());

				if($this->validateForms($inputs) === true)
				{

					 $post->title = Input::get("title");
					 $post->content = Input::get("content");

					 if($post->save())
					 {

					     return Redirect::to('crud/show')->with(array('mensaje' => 'El post se ha actualizado correctamente.'));

					 }

				}else{

					return Redirect::to("crud/update/$id")->withErrors($this->validateForms($inputs))->withInput();

				}

			}else{

				return Redirect::to('crud/show')->with(array('mensaje' => 'El post no existe.'));
				
			}

		}else{

			return View::make("update", array("post" => $post));
			
		}

	}

	//método para eliminar un post, si existe se elimina, en otro caso mandamos un msje conforme no existe.
	public function delete($id)
	{

		$post = Post::find($id);
		if($post)
		{

			$post->delete();
			return Redirect::to('crud/show')->with(array('mensaje' => 'El post ha sido eliminado correctamente.'));

		}else{

			return Redirect::to('crud/show')->with(array('mensaje' => "El post con id $id que intentas eliminar no existe."));

		}

	}

	//método privado para validar los formularios, al fin y al cabo, siempre son iguales
	//reutilización de código
	private function validateForms($inputs = array())
	{

	    $rules = array(
	        'title'  	=> 'required|min:2|max:100',
	        'content'   => 'required|min:6|max:255'
	    );
	        
	    $messages = array(
	        'required'  => 'El campo :attribute es obligatorio.',
	        'min'       => 'El campo :attribute no puede tener menos de :min carácteres.',
	        'max'       => 'El campo :attribute no puede tener más de :min carácteres.'
	    );
    
    	$validation = Validator::make($inputs, $rules, $messages);

    	if($validation->fails())
    	{

    		return $validation;

    	}else{

    		return true;

    	}

	}

	//método privado para obtener los inputs del formulario, siempre son los mismos
	//reutilización de código
	private function getInputs($inputs = array())
	{

		foreach($inputs as $key => $val)
		{
			$inputs[$key] = $val;
		}
		return $inputs;
	}

}
<?php

namespace App\Http\Controllers;

use \App\Model\Books;
use Illuminate\Http\Request;
use App\Http\Resources\BookResource;
use \App\Http\Resources\BooksCollection;
use App\Http\Resources\CreateAndUpdateBookResource;


class BooksController extends Controller
{
   
    private  $status_code = 200;
    private  $status = 'success';

    /**
     * Display a listing of all the books.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Books $books)
    {       
        $data = Books::all();
        return  $this->displayApiResponse($data);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        
        $request['authors'] = [$request->authors];
       $books = new Books($request->all());
       $books->save();
       return response()->json(
        array(
            'status_code' => 201,
            'status' => $this->status, 
            'data' => new CreateAndUpdateBookResource($books)
        )
    );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Books::find($id);
        return response()->json(
            array(
                'status_code' => $this->status_code,
                'status' => $this->status, 
                'data' =>  new CreateAndUpdateBookResource($data)
            )
        );
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request['authors'] = [$request->authors];

        $data = Books::find($id);
        if($data)
            $data->update($request->all());
        $name = Books::where('id', $id)->value('name');
        $message =  "The book My". $data->name ." was updated successfully";
        return response()->json(
            array(
                'status_code' => $this->status_code,
                'status' => $this->status, 
                'message' => $message,
                'data' => new CreateAndUpdateBookResource($data)
            )
        );
      
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $name = Books::where('id', $id)->value('name');
        $data = Books::where('id', $id)->delete();
        $message =  "The book ". $name ." was deleted successfully";
        return response()->json(
            array(
                'status_code' => "204",
                'status' => $this->status, 
                'message' => $message,
                'data' =>[]
            )
        );
    }

    
    /**
     * Remove the specified Book by its name.
     *
     * @param  string  $name
     * @return \Illuminate\Http\Response
     */
    public function getBookByName()
    {
        $response = file_get_contents('https://www.anapioficeandfire.com/api/books');
       
       
// decode json to associative array
$json_arr = json_decode($response, true);

// get array index to delete
$arr_index = array();
foreach ($json_arr as $key => $value)
{
    if ($value['characters'] == array())
    {
        $arr_index[] = $key;
    }
}

// delete data
foreach ($arr_index as $i)
{
    unset($json_arr[$i]);
}

// rebase array
$json_arr = array_values($json_arr);
return $json_arr;
       

        // return $response;
        $name = $_GET['name'];  
        $data = Books::where('name', $name)->get(['id', 'name', 'isbn', 'authors', 'number_of_pages', 'publisher', 'country', 'release_date']);
       return  $this->displayApiResponse($data);
    }

    /**
     * Display data from query as rest api.
     *
     * @return \Illuminate\Http\Response
     */
    public function displayApiResponse($data){
        return response()->json(
            array(
                'status_code' => $this->status_code,
                'status' => $this->status, 
                'data' =>  BookResource::collection($data)
            )
        );
    }
}

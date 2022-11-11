<?php namespace App\Controllers;
 
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;
use App\Models\Post;
 
class PostController extends ResourceController
{
    use ResponseTrait;

    // Semua data
    public function index()
    {
        $model = new Post();
        $data = $model->findAll();
        
        return $this->respond($data, 200);
    }

    // Detail data
    public function show($id = null)
    {
        $model = new Post();
        $data = $model->getWhere(['id' => $id])->getResult();

        if ($data) {
            return $this->respond($data, 200);
        }else{
            return $this->failNotFound('Id '.$id.' tidak ditemuakan');
        }
    }

    // Tambah data
    public function create()
    {
        helper('date');

        $model = new Post();
        $data = [
            'title' => $this->request->getPost('title'),
            'thumbnail' => $this->request->getPost('thumbnail'),
            'body' => $this->request->getPost('body'),
            'created_at' => date('Y-m-d'),
            'updated_at' => date('Y-m-d'),
        ];
        // // $data = json_decode(file_get_contents("php://input"));
        $model->insert($data);
        $response = [
            'status'   => '201',
            'error'    => null,
            'messages' => [
                'success' => 'Data Saved'
            ]
        ];

        return $this->respondCreated($response, 201);
    }

    // Edit data
    public function update($id = null)
    {
        $model = new Post();
        $json = $this->request->getJSON();

        if ($json) {
            $data = [
                'title' => $json->title,
                'thumbnail' => $json->thumbnail,
                'body' => $json->body,
                'updated_at' => date('Y-m-d'),
            ];
        }else{
            $input = $this->request->getRawInput();
            $data = [
                'title' => $input['title'],
                'thumbnail' => $input['thumbnail'],
                'body' => $input['body'],
                'updated_at' => date('Y-m-d'),
            ];
        }

        $model->update($id, $data);
        $response = [
            'status'   => '200',
            'error'    => null,
            'messages' => [
                'success' => 'Data Updated'
            ]
        ];

        return $this->respond($response);
    }

    public function delete($id = null)
    {
        $model = new Post();
        $data = $model->find($id);
        $model->delete($id);
        if ($data) {
            $response = [
                'status'   => 200,
                'error'    => null,
                'messages' => [
                    'success' => 'Data Deleted'
                ]
            ];
             
            return $this->respondDeleted($response);
        }else{
            return $this->failNotFound('Data dengan id = '.$id.' tidak ditemukan');
        }
    }
}
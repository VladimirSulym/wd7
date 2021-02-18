<?php

class RestController extends controller
{
    private $db = [
        1 => [
            'id' => 1,
            'name' => 'cpu',
            'vendor' => 'intel',
            'model' => 'core i7',
            'description' => '.....'
        ],
        3 => [
            'id' => 3,
            'name' => 'ram',
            'vendor' => 'samsung',
            'model' => 'bf18',
            'description' => '.....'
        ],
        10 => [
            'id' => 10,
            'name' => 'hdd',
            'vendor' => 'kingston',
            'model' => 'ea99',
            'description' => '.....'
        ],
    ];
    
    // GET      /rest
    // GET /?controller=rest
    public function actionGet()
    {
        echo json_encode($this->db);
    }
    
    // GET      /rest/10
    // GET /controller=rest&id=10
    public function actionView()
    {
        echo json_encode($this->db[$_GET['id']]);
    }
    
    // POST     /rest        | request payload: {"name":"ssd","vendor":"seagate","model":"zzz-0001"}
    // POST /?controller=rest | request payload: {"name":"ssd","vendor":"seagate","model":"zzz-0001"}
    public function actionCreate()
    {
        $data = getRequestPayload();
        array_push($this->db, json_decode($data, true));
        end($this->db);
        echo json_encode(['id' => key($this->db)]);
    }
    
    // PUT      /rest/10     | request payload: {"model":"ea-99"}
    // PUT /?controller=rest&id=10 | request payload: {"model":"ea-99"}
    public function actionUpdate()
    {
        $data = getRequestPayload();
        $data = json_decode($data, true);
        $this->db[$_GET['id']] = array_merge($this->db[$_GET['id']], $data);
    }
    
    // DELETE   /rest/10
    // DELETE /?controller=rest&id=10
    public function actionDelete()
    {
        unset($this->db[$_GET['id']]);
    }
}

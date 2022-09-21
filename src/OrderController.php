<?php

class UserController
{
    public function __construct(private Order $order)
    {
        
    }

    public function processRequest(string $method, ?string $id) : void
    {
        if($id){
            $this->processResourcesRequest($method, $id);
        }
        else{
            $this->processCollectionRequest($method);
        }
    }

    public function processResourcesRequest(string $method, string $sting): void
    {

    }

    public function processCollectionRequest(string $method)
    {
        switch ($method) {
            case 'GET':
                echo json_encode($this->order->getAll());
                break;
            case "POST":
                $data = (array) json_decode(file_get_contents("php://input", true));
                echo json_encode($this->order->create($data));
                break;
            default:
                echo "Invalid Request Method";
                break;
        }
    }
}
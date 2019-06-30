<?php



class image{



    private $save_path = 'foto/';

    private $image_string = '';

    private $image_name = '';

    private $image;

    private $response = array();



    public $loaded = false;



    public function __construct(){

        $this->response = array(

            'success' => 0,

            'message' => 'unknown error.'

        );

        $this->image_string = filter_input(INPUT_POST, 'image');

        if(!empty($this->image_string)){

            $this->loaded = true;

        }

    }



    public function save($NamaFile){

        if(!empty($NamaFile) && !empty($this->image_string)){

            return $this->progress($NamaFile);

        }

        else{

            $this->response['message'] = 'Error. Not all required infor is given.';

            return $this->response;

        }

    }



    private function progress($NamaFile){

        $imgarr = explode(',', $this->image_string);

        if(!isset($imgarr[1])){

            $this->response['message'] = 'Error on post data image. String is not the expected string.';

            return $this->response;

        }

        $this->image = base64_decode($imgarr[1]);

        if(!is_null($this->image)){

            $file = $this->save_path . $NamaFile;

            if(file_exists($file)){

                $this->response['message'] = 'Image already exists on server.';

                return $this->response;

            }

            if(file_put_contents($file, $this->image) !== false){

                $this->response['error'] = 1;

                $this->response['message'] = 'Image saved to server';

                return $this->response;

            }

            else{

                $this->response['message'] = 'Error writing file to disk';

                return $this->response;

            }

        }

        else{

            $this->response['message'] = 'Error decoding base64 string.';

            return $this->response;

        }

    }

}



$img = new image();

if($img->loaded){

    $result = $img->save($NamaFile);

    //echo json_encode($result);

    redirect(base_url().'dashboard');

}

else{

    $result = array(

        'success' => 0,

        'message' => 'Not all post data given'

    );

    //echo json_encode($result);

    redirect(base_url().'dashboard');

}

?>
<?php
    class Response{
        public function success($result=[], $code = 200, $message= 'success'){
            $response = array(
                'status' => true,
                'response' => $result,
                'message' => $message
            );
            http_response_code($code);
            echo json_encode($response);
        }

        public function error($message = 'error', $code = 400){
            $response = array(
                'status' => false,
                'message' => $message 
            );
            http_response_code($code);
            echo json_encode($response);
        }

        public function PUTsuccess($result,$code=201,$message='Created success'){
            $response = array(
                'status' => true,
                'response' => $result,
                'message' => $message
            );
            http_response_code($code);
            echo json_encode($response);
        }
        public function update($code=200,$message='Update success'){
            $response = array(
                'status' => true,
                'message' => $message
            );
            http_response_code($code);
            echo json_encode($response);
        }
        public function delete($code=200,$message='delete success'){
            $response = array(
                'status' => true,
                'message' => $message
            );
            http_response_code($code);
            echo json_encode($response);
        }
        
    }
?>
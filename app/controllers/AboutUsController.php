<?php

    class AboutUsController extends Controller{
        public function index()
        {
            $this->view('LayoutUser', [
                "user" => "AboutUs",
                 "paragraph"=>"welcome to About Us."
            ]);
            
        }
        
    }
?>
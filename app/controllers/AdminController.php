<?php
    class AdminController extends Controller
    {
        public function index()
        {
            $this->view('LayoutAdmin',[
                "admin" =>"products/index"
            ]);
        }
    }
?>
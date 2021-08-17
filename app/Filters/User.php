<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class User implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();  
        if(isset($_SESSION['login']) && $_SESSION['login']['role'] == 3)
        {
            // echo "b";
            // die;
            return redirect()->to('/tutorialTube/public/Admin/AdminClass');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
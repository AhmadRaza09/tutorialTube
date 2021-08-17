<?php

namespace App\Filters;

use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Filters\FilterInterface;

class SeriesCreateAuth implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();  
        if(!(isset($_SESSION['login']['role'])))
        {
            // echo "b";
            // die;
            return redirect()->to('/tutorialTube/public/User');
        }
        elseif(isset($_SESSION['login']['role']) && $_SESSION['login']['role'] == 1 )
        {
            return redirect()->to('/tutorialTube/public/User');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do something here
    }
}
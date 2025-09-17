<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * BaseController akan dipanggil oleh semua Controller lain
 * untuk inisialisasi request, response, logger, helper, dll.
 */
class BaseController extends Controller
{
    /**
     * Instance dari Request
     *
     * @var RequestInterface
     */
    protected $request;

    /**
     * Daftar helper yang akan di-load otomatis
     *
     * @var array
     */
    protected $helpers = [];

    /**
     * Konstruktor utama controller.
     * Jangan dihapus baris `parent::initController()`
     */
    public function initController(
        RequestInterface $request,
        ResponseInterface $response,
        LoggerInterface $logger
    ) {
        // Jangan edit baris ini
        parent::initController($request, $response, $logger);

        // Tempatkan preload model, library, service di sini jika diperlukan.
        // Contoh:
        // $this->session = \Config\Services::session();
    }
}

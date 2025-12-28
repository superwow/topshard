<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\IncomingRequest;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BaseController
 *
 * Provides a convenient place for loading components
 * and performing functions that are needed by all controllers.
 */
abstract class BaseController extends Controller
{
    /**
     * Instance of the main Request object.
     *
     * @var IncomingRequest
     */
    protected $request;

    /**
     * An array of helpers to be automatically loaded.
     *
     * @var array<string>
     */
    protected $helpers = ['url', 'form'];

    /**
     * Preloads common services.
     */
    public function initController(IncomingRequest $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);
    }
}

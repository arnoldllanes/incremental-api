<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Response;

class ApiController extends Controller
{
	/**
     * @var int Status Code.
     */
  	protected $statusCode = 200;

  	
  	/**
     * Getter method to return stored status code.
     *
     * @return mixed
     */
  	public function getStatusCode()
  	{
  		return $this->statusCode;

  	}

  	/**
     * Setter method to set status code.
     * It is returning current object
     * for chaining purposes.
     *
     * @param mixed $statusCode
     * @return current object.
     */
  	public function setStatusCode($statusCode)
  	{
  		$this->statusCode = $statusCode;

  		return $this;
  	}

  	/**
     * Function to return a Not Found response.
     *
     * @param string $message
     * @return mixed
     */
  	public function respondNotFound($message = 'Not Found!')
  	{
  		return $this->setStatusCode(\Illuminate\Http\Response::HTTP_NOT_FOUND)->respondWithError($message);	
  	}

  	public function respondInternalError($message = 'Internal Error!')
  	{
  		return $this->setStatusCode(500)->respondWithError($message);
  	}

  	/**
     * Function to return a generic response.
     *
     * @param $data Data to be used in response.
     * @param array $headers Headers to b used in response.
     * @return mixed Return the response.
     */
  	public function respond($data, $headers = [])
  	{
  		return Response::json($data, $this->getStatusCode(), $headers);
  	}

  	/**
     * Function to return an error response.
     *
     * @param $message
     * @return mixed
     */
  	public function respondWithError($message)
  	{
  		return $this->respond([
  			'error' => [
  				'message' => $message,
  				'status_code' => $this->getStatusCode()
  			]
  		]);
  	}

/**
 * 
 * @return mixed
 * @return message
 **/
  	protected function respondCreated($message)
    {
        return $this->setStatusCode(201)->respond([
            'message' => $message
        ]);
	}
}

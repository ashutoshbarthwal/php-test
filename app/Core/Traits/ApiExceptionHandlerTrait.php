<?php

namespace App\Core\Traits;

use App\Exceptions\DatabaseTransactionFailedException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\PermissionDeniedException;
use App\Validations\ValidationException;
use Exception;
use Illuminate\Http\Request;

trait ApiExceptionHandlerTrait
{

    use ApiResponseHandlerTrait;

    /**
     * Creates a new JSON response based on exception type.
     *
     * @param Request $request
     * @param Exception $e
     * @return \Illuminate\Http\JsonResponse
     */
    protected function getJsonResponseForException(Request $request, Exception $e)
    {
        switch (true) {
            case $this->isModelNotFoundException($e):
                $retval = $this->modelNotFound($e->getMessage(),404);
                break;
            case $this->isValidationException($e):
                $retval = $this->validationException($e);
                break;
            case $this->isPermissionDeniedException($e):
                $retval = $this->permissionDenied($e->getMessage());
                break;
            case $this->isDBTransactionException($e):
                $retval = $this->dbTransactionFailed($e->getMessage());
                break;
            default:
                if(env('API_DEBUG',true)){
                    $retval = $this->badRequest($e->getMessage() . $e->getLine() . $e->getFile());
                }else{
                    $retval = $this->badRequest(["erros"=>["message"=>"OOPS! Something went wrong"]]);
                }
        }
        return $retval;
    }

    /**
     * Determines if the given exception is an Eloquent model not found.
     *
     * @param Exception $e
     * @return bool
     */
    protected function isModelNotFoundException(Exception $e)
    {
        return $e instanceof ModelNotFoundException;
    }

    /**
     * Returns json response for Eloquent model not found exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function modelNotFound($message = 'Record not found', $statusCode = 404)
    {
        return $this->errorNotFound($message,$statusCode);
    }

    /**
     * @param Exception $e
     * @return bool
     */
    protected function isValidationException(Exception $e)
    {
        return $e instanceof ValidationException;
    }

    public function validationException($e)
    {
        return $this->errorWrongArgs($this->transformValidationErrors($e));
    }

    /**
     * @param Exception $e
     * @return bool
     */
    protected function isPermissionDeniedException(Exception $e)
    {
        return $e instanceof PermissionDeniedException;
    }

    /**
     * Returns json response for Permission denial  exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function permissionDenied($message = 'No Permission to this action', $statusCode = 403)
    {
        return $this->errorForbidden($message);
    }

    /**
     * @param Exception $e
     * @return bool
     */
    protected function isDBTransactionException(Exception $e)
    {
        return $e instanceof DatabaseTransactionFailedException;
    }

    /**
     * Returns json response for Permission denial  exception.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function dbTransactionFailed($message = 'Database denied to accept query', $statusCode = 403)
    {
        return $this->errorInternalServiceError($message);
    }

    /**
     * Returns json response for generic bad request.
     *
     * @param string $message
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function badRequest($message = 'Bad request', $statusCode = 400)
    {
        if(env('API_DEBUG',true)){
            return $this->errorWrongArgs($message);
        }else{
            return response()->json($message, $statusCode);
        }
    }

    /**
     * Returns json response.
     *
     * @param array|null $payload
     * @param int $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    protected function jsonResponse(array $payload = null, $statusCode = 404)
    {
        $payload = $payload ?: [];

        return response()->json($payload, $statusCode);
    }

}

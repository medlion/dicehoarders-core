<?php


namespace App\ExceptionHandling;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    /**
     * @param ExceptionEvent $exceptionEvent
     * @return JsonResponse
     */
    public function onKernelException (ExceptionEvent $exceptionEvent)
    {
        $message = 'An Error Has Occurred';
        if ($exceptionEvent->getException() instanceof UserFriendlyException) {
            $message = $exceptionEvent->getException()->getMessage();
        }

        $code = 400;

        $exceptionEvent->setResponse(new JsonResponse(['message' => $message]), $code);
    }
}

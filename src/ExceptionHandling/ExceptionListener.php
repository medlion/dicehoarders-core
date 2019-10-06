<?php


namespace App\ExceptionHandling;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;

class ExceptionListener
{
    /**
     * @param ExceptionEvent $exceptionEvent
     */
    public function onKernelException (ExceptionEvent $exceptionEvent)
    {
        /** TODO Implement admin to get special exceptions */

        $message = 'Please navigate to https://xkcd.com/2200/ ';
        //if ($exceptionEvent->getException() instanceof UserFriendlyException) {
            $message = $exceptionEvent->getException()->getMessage();
        //}

        $code = 400;

        //$exceptionEvent->setResponse(new JsonResponse(['code' => $code, 'message' => $message]), $code);
    }
}

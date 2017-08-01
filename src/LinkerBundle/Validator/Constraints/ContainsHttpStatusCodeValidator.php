<?php
namespace LinkerBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class ContainsHttpStatusCodeValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        $httpStatusCode = true;

        $handle = curl_init($value);
        curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);
        //Get the link content.
        $response = curl_exec($handle);
        //Check status code
        $httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
        if($httpCode < 200 || ($httpCode > 206 && $httpCode < 300) || $httpCode > 307) {
            $this->context->buildViolation($constraint->message)
                ->setParameter('{{ url }}', $value)
                ->setParameter('{{ httpCode }}', $httpCode)
                ->addViolation();
        }
        curl_close($handle);

    }
}
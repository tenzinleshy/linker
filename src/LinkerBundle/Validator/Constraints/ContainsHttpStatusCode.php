<?php
namespace LinkerBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class ContainsHttpStatusCode extends Constraint
{
    public $message = 'The URL "{{ url }}" is not responding. Check it or enter another. Http Code: "{{ httpCode }}"';
}
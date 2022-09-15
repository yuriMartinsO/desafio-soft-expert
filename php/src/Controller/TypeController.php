<?php

namespace Manager\Controller;

use Manager\Model\RequestBuilders\TypeRequestBuilder;
use Manager\Model\Type;
use Manager\Model\Validators\TypeValidator;

/**
 * Controller class of type
 */
class TypeController
{
    /**
     * Create a new type
     *
     * @return string
     */
    public function create(): string
    {
        $typeBuilder = new TypeRequestBuilder(new Type());
        $type = $typeBuilder->build($_POST);

        $validator = (new TypeValidator($type))->validate();
        if ($validator->getErrors()) {
            return json_encode([
                'error' => true,
                'errorsMessages' => $validator->getErrors()
            ]);
        }

        try {
            $saved = $type->save();
        } catch (\Exception $e) {
            return json_encode([
                'error' => true,
                'errorsMessages' => $e->getMessage()
            ]);
        }

        if (!$saved) {
            return json_encode([
                'error' => true,
                'errorsMessages' => 'Não foi possível cadastrar tipo'
            ]);
        }

        return json_encode([
            'error' => false,
            'data' => $type->toArray()
        ]);
    }
}
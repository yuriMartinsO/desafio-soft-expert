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
        $data = json_decode(file_get_contents('php://input'), true);

        if (!$data) {
            http_response_code(400);
            return json_encode([
                'error' => true,
                'errorsMessages' => 'Nenhum dado foi recebido'
            ]);

        }

        $typeBuilder = new TypeRequestBuilder(new Type());
        $type = $typeBuilder->build($data);

        $validator = (new TypeValidator($type))->validate();
        if ($validator->getErrors()) {
            http_response_code(400);
            return json_encode([
                'error' => true,
                'errorsMessages' => $validator->getErrors()
            ]);
        }

        try {
            $saved = $type->save();
        } catch (\Exception $e) {
            http_response_code(400);
            return json_encode([
                'error' => true,
                'errorsMessages' => $e->getMessage()
            ]);
        }

        if (!$saved) {
            http_response_code(500);
            return json_encode([
                'error' => true,
                'errorsMessages' => 'Não foi possível cadastrar tipo'
            ]);
        }

        http_response_code(201);
        return json_encode([
            'error' => false,
            'data' => $type->toArray()
        ]);
    }
}
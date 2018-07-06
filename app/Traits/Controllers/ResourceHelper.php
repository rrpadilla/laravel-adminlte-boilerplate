<?php

namespace App\Traits\Controllers;

use Validator;
use Illuminate\Http\Request;

trait ResourceHelper
{
    /**
     * @return string
     */
    private function getResourceAlias()
    {
        if (property_exists($this, 'resourceAlias') && ! empty($this->resourceAlias)) {
            return $this->resourceAlias;
        } else {
            throw new \InvalidArgumentException('The property "resourceAlias" is not defined');
        }
    }

    /**
     * @return string
     */
    private function getResourceRoutesAlias()
    {
        if (property_exists($this, 'resourceRoutesAlias') && ! empty($this->resourceRoutesAlias)) {
            return $this->resourceRoutesAlias;
        } else {
            return $this->getResourceAlias();
        }
    }

    /**
     * @return string
     */
    private function getResourceTitle()
    {
        if (property_exists($this, 'resourceTitle') && ! empty($this->resourceTitle)) {
            return $this->resourceTitle;
        } else {
            return $this->getResourceAlias();
        }
    }

    /**
     * @return mixed
     */
    private function getResourceModel()
    {
        if (property_exists($this, 'resourceModel') && ! empty($this->resourceModel)) {
            return $this->resourceModel;
        } else {
            throw new \InvalidArgumentException('The property "resourceModel" is not defined');
        }
    }

    /**
     * Validate the given request with the given rules.
     *
     * @param \Illuminate\Http\Request $request
     * @param $action
     * @param null $record
     * @throws \Illuminate\Validation\ValidationException
     */
    private function resourceValidate(Request $request, $action, $record = null)
    {
        if ($action == 'store') {
            $validation = $this->resourceStoreValidationData();
        } else {
            $validation = $this->resourceUpdateValidationData($record);
        }
        $validation['rules'] = is_array($validation['rules']) ? $validation['rules'] : [];
        $validation['messages'] = is_array($validation['messages']) ? $validation['messages'] : [];
        $validation['attributes'] = is_array($validation['attributes']) ? $validation['attributes'] : [];
        if (! isset($validation['advanced']) || ! is_array($validation['advanced'])) {
            $validation['advanced'] = [];
        }

        if (count($validation['advanced'])) {
            $v = Validator::make(
                $request->all(),
                $validation['rules'],
                $validation['messages'],
                $validation['attributes']
            );

            // DOC: https://laravel.com/docs/5.6/validation
            foreach ($validation['advanced'] as $data) {
                if (isset($data['attribute']) && isset($data['rules']) && is_callable($data['callback'])) {
                    $v->sometimes($data['attribute'], $data['rules'], $data['callback']);
                }
            }

            $v->validate();
        } else {
            $this->validate($request, $validation['rules'], $validation['messages'], $validation['attributes']);
        }
    }

    /**
     * Classes using this trait have to implement this method.
     * Used to validate store.
     *
     * @return array
     */
    private function resourceStoreValidationData()
    {
        return [
            'rules' => [],
            'messages' => [],
            'attributes' => [],
            'advanced' => [],
        ];
    }

    /**
     * Classes using this trait have to implement this method.
     * Used to validate update.
     *
     * @param $record
     * @return array
     */
    private function resourceUpdateValidationData($record)
    {
        return [
            'rules' => [],
            'messages' => [],
            'attributes' => [],
            'advanced' => [],
        ];
    }

    /**
     * Classes using this trait have to implement this method.
     *
     * @param \Illuminate\Http\Request $request
     * @param null $record
     * @return array
     */
    private function getValuesToSave(Request $request, $record = null)
    {
        return $request->only($this->getResourceModel()::getFillableFields());
    }

    private function alterValuesToSave(Request $request, $values)
    {
        return $values;
    }

    /**
     * @param $record
     * @return bool
     */
    private function checkDestroy($record)
    {
        return true;
    }

    /**
     * Classes using this trait have to implement this method.
     * Retrieve the list of the resource.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $perPage
     * @param string|null $search
     * @return \Illuminate\Support\Collection
     */
    private function getSearchRecords(Request $request, $perPage = 15, $search = null)
    {
        return $this->getResourceModel()::paginate($perPage);
    }

    /**
     * @param $record
     * @return \Illuminate\Http\Response
     */
    private function getRedirectAfterSave($record)
    {
        return $this->redirectBackTo(route($this->getResourceRoutesAlias().'.index'));
    }

    /**
     * @param array $data
     * @return array
     */
    private function filterCreateViewData($data = [])
    {
        return $data;
    }

    /**
     * @param $record
     * @param array $data
     * @return array
     */
    private function filterEditViewData($record, $data = [])
    {
        return $data;
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param array $data
     * @return array
     */
    private function filterSearchViewData(Request $request, $data = [])
    {
        return $data;
    }

    /**
     * @param $callbackUrl
     * @param int $status
     * @param array $headers
     * @param null $secure
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    private function redirectBackTo($callbackUrl, $status = 302, $headers = [], $secure = null)
    {
        return redirect_back_to($callbackUrl, $status, $headers, $secure);
    }
}

<?php

namespace PandaLeague\OpenApiBuilder\SecurityFlow;

use PandaLeague\OpenApiBuilder\SecuritySchemeObject;

class OAuthFlow extends SecuritySchemeObject
{
    protected $type = 'oauth2';
    protected $flows = [];

    public function addFlow($authFlowObject): self
    {
        $this->flows[$authFlowObject->type()] = $authFlowObject;

        return $this;
    }

    public function toArray()
    {
        $return = ['type' => $this->type, 'flows' => []];

        foreach ($this->flows as $key => $flow) {
            $return['flows'][$key] = $flow->toArray();
            unset($return['flows'][$key]['type']);
        }

        return $return;
    }
}

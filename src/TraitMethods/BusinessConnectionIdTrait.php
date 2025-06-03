<?php
namespace Botfire\TraitMethods;

trait BusinessConnectionIdTrait
{
    

    /**
     * Unique identifier of the business connection on behalf of which the message will be sent
     * @param string $business_connection_id
     * @return static
     */
    public function businessConnectionId(string $business_connection_id)
    {
        $this->data['business_connection_id'] = $business_connection_id;
        return $this;
    }
}

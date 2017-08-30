<?php declare(strict_types=1);

namespace Shopware\Product\Gateway\Resource;

use Shopware\Framework\Api2\ApiFlag\Required;
use Shopware\Framework\Api2\Field\FkField;
use Shopware\Framework\Api2\Field\IntField;
use Shopware\Framework\Api2\Field\ReferenceField;
use Shopware\Framework\Api2\Field\StringField;
use Shopware\Framework\Api2\Field\BoolField;
use Shopware\Framework\Api2\Field\DateField;
use Shopware\Framework\Api2\Field\SubresourceField;
use Shopware\Framework\Api2\Field\LongTextField;
use Shopware\Framework\Api2\Field\LongTextWithHtmlField;
use Shopware\Framework\Api2\Field\FloatField;
use Shopware\Framework\Api2\Field\TranslatedField;
use Shopware\Framework\Api2\Field\UuidField;
use Shopware\Framework\Api2\Resource\ApiResource;

class ProductConfiguratorSetGroupRelationResource extends ApiResource
{
    public function __construct()
    {
        parent::__construct('product_configurator_set_group_relation');
        
        $this->primaryKeyFields['setId'] = new IntField('set_id');
        $this->primaryKeyFields['uuid'] = (new UuidField('uuid'))->setFlags(new Required());
        $this->primaryKeyFields['groupId'] = new IntField('group_id');
    }
    
    public function getWriteOrder(): array
    {
        return [
            \Shopware\Product\Gateway\Resource\ProductConfiguratorSetGroupRelationResource::class
        ];
    }
}
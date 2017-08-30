<?php
declare(strict_types=1);
/**
 * Shopware 5
 * Copyright (c) shopware AG
 *
 * According to our dual licensing model, this program can be used either
 * under the terms of the GNU Affero General Public License, version 3,
 * or under a proprietary license.
 *
 * The texts of the GNU Affero General Public License with an additional
 * permission and of our proprietary license can be found at and
 * in the LICENSE file you have received along with this program.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU Affero General Public License for more details.
 *
 * "Shopware" is a registered trademark of shopware AG.
 * The licensing of the program under the AGPLv3 does not imply a
 * trademark license. Therefore any rights, title and interest in
 * our trademarks remain entirely with us.
 */

namespace Shopware\Framework;

use Shopware\Framework\DependencyInjection\ApiRegistryCollector;
use Shopware\Framework\DependencyInjection\FrameworkExtension;
use Shopware\Framework\Doctrine\BridgeDatabaseCompilerPass;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class Framework extends Bundle
{
    const VERSION = '___VERSION___';
    const VERSION_TEXT = '___VERSION_TEXT___';
    const REVISION = '___REVISION___';

    protected $name = 'Shopware';

    /**
     * {@inheritdoc}
     */
    public function getContainerExtension(): Extension
    {
        return new FrameworkExtension();
    }

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container): void
    {
        parent::build($container);

        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/DependencyInjection/'));
        $loader->load('services.xml');
//        $loader->load('api.xml');
        $loader->load('api2.xml');
        $loader->load('api2-resources.xml');

        $container->addCompilerPass(new BridgeDatabaseCompilerPass());
        $container->addCompilerPass(new ApiRegistryCollector());
    }
}
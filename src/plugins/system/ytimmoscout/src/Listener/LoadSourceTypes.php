<?php

namespace Joomla\Plugin\System\Ytimmoscout\Listener;

use Joomla\Plugin\System\Ytimmoscout\Type\RealestatesQueryType;
use Joomla\Plugin\System\Ytimmoscout\Type\RealestatesType;
use Joomla\Plugin\System\Ytimmoscout\Type\RealestateQueryType;
use Joomla\Plugin\System\Ytimmoscout\Type\RealestateType;


class LoadSourceTypes
{
    public function handle($source): void
    {
        $query = [
            RealestateQueryType::config(),
            RealestatesQueryType::config(),

        ];

        $types = [
            ['Realestate', RealestateType::config()],
            ['Realestates', RealestatesType::config()],
        ];

        foreach ($query as $args) {
            $source->queryType($args);
        }

        foreach ($types as $args) {
            $source->objectType(...$args);
        }
    }
}

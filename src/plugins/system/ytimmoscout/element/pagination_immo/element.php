<?php
/**
* @package      DigiNerds VMMImmoscout24 Package
*
* @author       Christian Schuelling <info@diginerds.de>
* @copyright    2024 diginerds.de - All rights reserved.
* @license      GNU General Public License version 3 or later
*/

namespace YOOtheme;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Pagination\PaginationObject;
use YOOtheme\Builder\Joomla\Source\realestateHelper;

return [
    'transforms' => [
        'render' => function ($node, $params) {
            // Single realestate
            if (!isset($params['pagination'])) {
                $realestate = $params['item'] ?? ($params['realestate'] ?? false);

                if (!$realestate || !realestateHelper::applyPageNavigation($realestate)) {
                    return false;
                }

                $params['pagination'] = [
                    'previous' => $realestate->prev
                        ? new PaginationObject($realestate->prev_label, '', null, $realestate->prev)
                        : null,
                    'next' => $realestate->next
                        ? new PaginationObject($realestate->next_label, '', null, $realestate->next)
                        : null,
                ];
            }

            if (is_callable($params['pagination'])) {
                $params['pagination'] = $params['pagination']();
            }

            if (is_array($params['pagination'])) {
                $node->props['pagination_type'] = 'previous/next';
                $node->props['pagination'] = $params['pagination'];
                return;
            }

            // realestate Index
            if (empty($params['pagination']) || $params['pagination']->pagesTotal < 2) {
                return false;
            }

            $list = $params['pagination']->getPaginationPages();

            $total = $params['pagination']->pagesTotal;
            $current = (int) $params['pagination']->pagesCurrent;
            $endSize = 1;
            $midSize = 3;
            $dots = false;

            $pagination = [];

            if ($list['previous']['active']) {
                $pagination['previous'] = $list['previous']['data'];
            }

            $list['start']['data']->text = 1;
            $list['end']['data']->text = $total;

            for ($n = 1; $n <= $total; $n++) {
                $active =
                    $n <= $endSize ||
                    ($current && $n >= $current - $midSize && $n <= $current + $midSize) ||
                    $n > $total - $endSize;

                if ($active || $dots) {
                    if ($active) {
                        $pagination[$n] =
                            $n === 1
                                ? $list['start']['data']
                                : ($n === $total
                                    ? $list['end']['data']
                                    : $list['pages'][$n]['data']);

                        $pagination[$n]->active = $n === $current;
                    } else {
                        $pagination[$n] = new PaginationObject(Text::_('&hellip;'));
                    }

                    $dots = $active;
                }
            }

            if ($list['next']['active']) {
                $pagination['next'] = $list['next']['data'];
            }

            $node->props['pagination'] = $pagination;
        },
    ],
];

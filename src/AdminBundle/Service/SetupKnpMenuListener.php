<?php

namespace AdminBundle\Service;

use Avanzu\AdminThemeBundle\Event\SidebarMenuEvent;
use Avanzu\AdminThemeBundle\Model\MenuItemModel;
use Symfony\Component\HttpFoundation\Request;

class SetupKnpMenuListener
{
    public function onSetupMenu(SidebarMenuEvent $event)
    {
        $request = $event->getRequest();

        foreach ($this->getMenu($request) as $item) {
            $event->addItem($item);
        }
    }

    protected function getMenu(Request $request)
    {
        $menuItems = [];
        $content = new MenuItemModel('content', 'Контент', 'admin_homepage', [], 'iconclasses fa fa-folder');
        $menuItems[] = $content;
        $content->addChild(new MenuItemModel('content-all', 'Весь контент', 'admin_homepage'));


        return $this->activateByRoute($request->get('_route'), $request->get('_route_params'), $menuItems);
    }

    protected function activateByRoute($route, $routeParams, $items)
    {
        /** @var MenuItemModel $item */
        foreach ($items as $item) {
            if ($item->hasChildren()) {
                $this->activateByRoute($route, $routeParams, $item->getChildren());
            } else {
                if ($item->getRoute() == $route && $item->getRouteArgs() == $routeParams) {
                    $item->setIsActive(true);
                }
            }
        }

        return $items;
    }
}

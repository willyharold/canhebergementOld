<?php

namespace Nanotech\CanhebergementBundle\Controller;

use FOS\UserBundle\Controller\SecurityController as BaseController;

class SecurityController extends BaseController
{
    public function renderLogin(array $data)
    {
        $requestAttributes = $this->container->get('request')->attributes;
        if ($requestAttributes->get('_route') == 'fos_user_security_login') {
            $template = sprintf('NanotechCanhebergementBundle:client:login.html.twig');
        } else {
            $template = sprintf('FOSUserBundle:Security:login.html.twig');
        }

        return $this->container->get('templating')->renderResponse($template, $data);
    }

}
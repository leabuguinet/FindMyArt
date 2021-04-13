<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;
use Symfony\Component\HttpFoundation\RequestStack;
use Vich\UploaderBundle\Templating\Helper\UploaderHelper;


class AppExtension extends AbstractExtension
{
    private $requestStack;
    private $uploaderHelper;
    public function __construct(RequestStack $requestStack, UploaderHelper $uploaderHelper)
    {
        $this->requestStack = $requestStack;       
        $this->uploaderHelper = $uploaderHelper; 
    }

    public function getFunctions()
    {
        return [
            new TwigFunction('findmyart_display_image', [$this, 'displayImage']),
        ];
    }

    public function displayImage($object, $property)
    {
        // {{ app.request.schemeAndHttpHost }}{{ app.request.basePath ~ vich_uploader_asset(piece, 'imageFile') }}
        $request = $this->requestStack->getCurrentRequest();

        return $request->getSchemeAndHttpHost().$request->getBasePath().$this->uploaderHelper->asset($object, $property);

    }
}
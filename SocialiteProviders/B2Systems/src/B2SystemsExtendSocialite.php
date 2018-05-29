<?php

namespace SocialiteProviders\B2Systems;

use SocialiteProviders\Manager\SocialiteWasCalled;

class B2SystemsExtendSocialite
{
    /**
     * Execute the provider.
     */
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('b2systems', __NAMESPACE__.'\Provider');
    }
}

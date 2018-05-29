<?php

namespace App\Traits;

trait B2UserTrait
{
    /**
     * The User Credentials.
     *
     * e.g. access_token, refresh_token, etc.
     *
     * @var array
     */
    public $accessTokenResponseBody;

    public $refreshToken;

    public $expiresIn;

    /**
     * Set the credentials on the user.
     *
     * Might include things such as the token and refresh token
     *
     * @param array $accessTokenResponseBody
     *
     * @return $this
     */
    public function setAccessTokenResponseBody(array $accessTokenResponseBody)
    {
        $this->accessTokenResponseBody = $accessTokenResponseBody;

        return $this;
    }

    /**
     * Set the token on the user.
     *
     * @param  string  $token
     * @return $this
     */
    public function setToken($token)
    {
        $this->token = $token;

        return $this;
    }

    /**
     * Set the refresh token required to obtain a new access token.
     *
     * @param  string  $refreshToken
     * @return $this
     */
    public function setRefreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;

        return $this;
    }

    /**
     * Set the number of seconds the access token is valid for.
     *
     * @param  int  $expiresIn
     * @return $this
     */
    public function setExpiresIn($expiresIn)
    {
        $this->expiresIn = $expiresIn;

        return $this;
    }
}

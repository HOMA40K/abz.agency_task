<?php

namespace Tests\Unit;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use PHPUnit\Framework\TestCase;

class JwtTest extends TestCase
{
    /** @test */
    public function it_decodes_jwt_token_correctly()
    {
        // Arrange: Define a JWT token and secret
        $payload = ['email' => 'test@example.com'];
        $secret = 'secret123';
        $jwt = JWT::encode($payload, $secret, 'HS256');

        // Act: Decode the JWT token
        $decoded = JWT::decode($jwt, new Key($secret, 'HS256'));

        // Assert: Check if the decoded email matches
        $this->assertEquals('test@example.com', $decoded->email);
    }
    /** @test */
    public function it_throws_exception_for_invalid_jwt_token()
    {
        $this->expectException(\Firebase\JWT\SignatureInvalidException::class);

        // Arrange: Invalid JWT token
        $invalidToken = 'invalid.token.here';
        $secret = 'secret123';

        // Act & Assert: Attempt to decode invalid token, should throw exception
        JWT::decode($invalidToken, new Key($secret, 'HS256'));
    }

}
